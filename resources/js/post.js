import './bootstrap'

export const textarea = document.getElementById('bbcode-id');

export function htmlDecode(input) {
  let doc = new DOMParser().parseFromString(input, "text/html");
  return doc.documentElement.textContent;
}

if (textarea) {

  sceditor.create(textarea, {
    format: 'bbcode',
    icons: 'monocons',
    style: "/minified/themes/defaultdark.min.css",
    emoticons: '/emoticons',
    plugins: 'dragdrop',
    dragdrop: {
      // Array of allowed mime types or null to allow all
      allowedTypes: ['image/jpeg', 'image/png'],
      // Function to return if a file is allowed or not,
      // defaults to always returning true
      isAllowed: function (file) {
        return true;
      },
      // If to extract pasted files like images pasted as
      // base64 encoded URI's. Defaults to true
      handlePaste: true,
      // Method that handles the files / uploading etc.
      handleFile: function (file, createPlaceholder) {
        // createPlaceholder function will insert a
        // loading placeholder into the editor and
        // return an object with inert(html) and
        // cancel() methods

        // For example:
        var placeholder = createPlaceholder();

        asyncUpload(file).then(function (url) {
          // Replace the placeholder with the image HTML
          placeholder.insert('<img src=\'' + url + '\' class=\'image-upload\' />'); //need get id image
        }).catch(function () {
          // Error so remove the placeholder
          placeholder.cancel();
        });
      }
    },

    autofocus: true,
  });

  window.sceditorInstance = sceditor.instance(textarea);

  let textareaResponsive = document.getElementsByClassName('sceditor-container')[0];
  let insertTable = document.getElementsByClassName('sceditor-button-table')[0];

  insertTable.parentElement.remove();
  textareaResponsive.style.width = "100%";

}

function asyncUpload(file) {

  let headers = new Headers({
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').attributes.content.value
  });

  let form = new FormData();
  form.append('image', file);


  return fetch('/post/upload-image', {
    method: 'post',
    headers: headers,
    body: form
  }).then(function (response) {
    return response.json();
  }).then(function (result) {
    if (result.success) {
      imageId = result.data.idImageTmp;
      return result.data.link;
    }

    throw new Error('Upload error');
  });
}
