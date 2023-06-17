function getImage(data) {
  axios.post('/post/upload-image', data)
    .then((response) => {
      console.log(response.data)
      // document.getElementById('success').innerHTML = response.data.data.link;
      let imageUrl = response.data.data.link;
      if (imageUrl) {
        let img_url = imageUrl;

        let html = "<a  href=\"" + img_url + "\">" +
          "<img  src=\"" + img_url + "\" alt=\"Uploaded Image\" />" +
          "</a<";

        // let text = "[img]" + img_url + "[/img]";
        // This called wysiwygEditorInsertHtml on the parent windows
        // SCEditor instance
        parent.window.sceditorInstance.wysiwygEditorInsertHtml(html);

        // let bbcode = document.getElementsByTagName('iframe')[0].contentDocument.body.innerHTML.trim() + html;

        // document.getElementsByTagName('iframe')[0].contentDocument.body.innerHTML = bbcode;

      }
      else if (!imageUrl)
        alert("Error: Image not uploaded");
    })
    .catch((error) => {
      console.log(error)
    });
}



let uploadImage = document.getElementById('upload-image');

if (uploadImage) {
  uploadImage.onclick = () => {
    let data = new FormData()
    data.append('image', document.getElementById('image').files[0])
    data.append('user', 'hubot')
    console.log(data);
    getImage(data);
  }
}

