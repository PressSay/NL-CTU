
import axios from 'axios';
import './post'
import './uploadImage'
import { data } from 'autoprefixer';


let products = document.querySelector('#container-sanphams');
let product = document.querySelector('#show-product');
let productImages = document.querySelector('#product-images');
let productImagesButton = document.querySelector('#product-images-button');

let categoryProducts = document.querySelector('#category-products');
let carts = document.querySelector('#carts');
let createCart = document.querySelector('#create-cart');
let removeCart = document.querySelector('#remove-cart');

let cartsDetail = document.querySelector('#carts-detail');
let categoryProductsUpload = document.querySelector('#category-products-upload');


let orderPerson = document.querySelector('#order-person');
let orderSeller = document.querySelector('#order-seller');
let orderAdmin = document.querySelector('#order-admin');

let submitCategoryProduct = document.querySelector('#submit-category-product');
let editCategoryProduct = document.querySelector('#edit-category-product');

let rattingSubmit = document.querySelector('#ratting-submit');

let btnCloseAlert = document.getElementById('close-alert');
if (btnCloseAlert) {
  btnCloseAlert.onclick = () => {
    btnCloseAlert.parentElement.parentElement.classList.add('hidden');
    btnCloseAlert.parentElement.parentElement.classList.remove('alert-success');
    btnCloseAlert.parentElement.parentElement.classList.remove('alert-error');
  }
}
let iconAlert = document.getElementById('icon-alert');
let messageAlert = document.getElementById('message-alert');

if (rattingSubmit) {
  rattingSubmit.addEventListener('click', async function () {
    let productId = document.querySelector('#productId').getAttribute('data-product-id');
    let stars = document.getElementsByName('rating-1');
    let ratingValue;

    for (let i = 0; i < stars.length; i++) {
      if (stars[i].checked) {
        ratingValue = Number(stars[i].value);
        break;
      }
    }

    let dataSend = {
      NoiDung: document.querySelector('#ratting-content').value,
      Star: ratingValue,
      san_pham_id: productId
    };
    console.log(dataSend);
    axios.post('/danhgia', dataSend).then(function (response) {
      console.log(response);
      if (response.status == 201) {
        let icon = `
          <svg xmlns="http://www.w3.org/2000/svg"
          class="stroke-current flex-shrink-0 h-6 w-6"
          fill="none" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        `;
        iconAlert.innerHTML = icon;
        messageAlert.innerText = 'Your rate has been confirmed!';
        btnCloseAlert.parentElement.parentElement.classList.add('alert-success');
        btnCloseAlert.parentElement.parentElement.classList.remove('hidden');
      }
    }).catch(function (error) {
      console.log(error);
      let icon = `
        <svg xmlns="http://www.w3.org/2000/svg"
        class="stroke-current flex-shrink-0 h-6 w-6"
        fill="none" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      `;
      iconAlert.innerHTML = icon;
      messageAlert.innerText = 'Your rate hasn\'t been confirmed!';
      btnCloseAlert.parentElement.parentElement.classList.add('alert-error');
      btnCloseAlert.parentElement.parentElement.classList.remove('hidden');
    });
  });
}

let url = window.location.href;
let dataCategoryProduct = [];
let dataCarts = [];
let dataProduct = [];


if (submitCategoryProduct) {
  submitCategoryProduct.addEventListener('click', postCategoryProduct, false);
}

if (editCategoryProduct) {
  editCategoryProduct.addEventListener('click', putCategoryProduct, false);
}

url = url.split('/');


if (orderAdmin) {
  renderOrderAdmin();
}

if (orderPerson && orderSeller) {
  renderOrderPerson();
  renderOrderSeller();
}

if (cartsDetail) {
  rederCartDetail();
}

if (categoryProductsUpload) {
  let isEdit = (url[url.length - 1] == "productNS") ? false : true;
  renderCategoryProductUpload(isEdit);
}

if (product) {
  let productId = url[url.length - 1];
  renderProduct(productId);
}

if (carts) {
  renderCart();
}




if (products) {
  renderCategoryAndProduct();
}


async function renderCategoryAndProduct() {
  await renderCategoryProduct();
  // console.log(url);

  let isUser = (url[url.length - 2] == "upload") ? 1 : 0;

  let filterProduct = document.querySelector('#filter-product');
  filterProduct.addEventListener('click', () => {
    renderProducts(isUser);
  }, false);

  await renderProducts(isUser);
}

async function getDataCategoryProduct() {
  dataCategoryProduct = await axios.get('/loaisanpham');
  dataCategoryProduct = dataCategoryProduct.data.data;
}

async function getDataCarts() {
  dataCarts = await axios.get('/giohang');
  dataCarts = dataCarts.data.data;
}

async function getDataProducts(isUser) {
  let checkboxb = document.querySelectorAll('.checkbox-category');
  dataProduct = [];
  let lengthCheckbox = checkboxb.length;
  for (let i = 0; i < lengthCheckbox; i++) {
    if (checkboxb[i].checked) {
      let swoof = checkboxb[i].value;
      let product_cat = checkboxb[i].parentElement.children[1].innerHTML;
      let dataProductAwait = await axios.get('/sanpham?swoof=' + swoof + '&product_cat=' + product_cat + '&profile_id=' + isUser);
      dataProductAwait = dataProductAwait.data.data;

      dataProduct.push(dataProductAwait);
    }
  }

}

async function getDataProduct(productId) {
  let dataProductAwait = await axios.get('/sanpham/' + productId);
  dataProductAwait = dataProductAwait.data.data;
  dataProduct = dataProductAwait;

}

async function renderCategoryProduct() {
  await getDataCategoryProduct();
  let html = '';
  dataCategoryProduct.forEach(element => {
    html += `
    <li>
      <label class="flex items-center">
        <input type="checkbox" checked="checked" class="checkbox checkbox-xs checkbox-category" value="`+ element.maSo + `" />
        <p class="mx-1 my-1">`+ element.TenLoaiSanPham + `</p>
      </label>
    </li>
    `;
  });
  categoryProducts.innerHTML = html;
}

async function renderOrderPerson() {
  let dataOrderPerson = await axios.get('/donhang');
  dataOrderPerson = dataOrderPerson.data.data;
  let html = '';
  let col = 0;
  let first = true;

  dataOrderPerson.forEach(element => {
    if (col == 0) {
      if (!first) {
        html += `</div>`;
      }
      first = false;
      html += `<div class="flex flex-col w-full lg:flex-row mb-3">`;
    }
    col = (col + 1) % 3;
    html += `
    <div class="grid flex-grow card bg-base-200 rounded-box place-items-center">
      <div class="flex flex-col justify-center items-center mb-3">
        <p class="mx-1 my-1">`+ element.trangThai + `</p>
        <p class="mx-1 my-1">`+ element.tongTien + `</p>
        <p class="mx-1 my-1">`+ element.ngayLap + `</p>
        <p class="mx-1 my-1">`+ element.phiShip + `</p>
        <p class="mx-1 my-1">`+ element.nguoiMua + `</p>
      </div>
    </div>`;
    if (col != 0)
      html += `<div class="divider lg:divider-horizontal"></div>`;
  });
  if (col != 0)
    html += `</div>`;

  orderPerson.innerHTML = html;

  if (col != 0) {
    orderPerson
      .children[orderPerson.children.length - 1]
      .children[
      orderPerson.children[orderPerson.children.length - 1].children.length - 1
    ].remove();
  }

}

async function renderOrderSeller() {
  let dataOrderSeller = await axios.get('/donhang/seller');
  dataOrderSeller = dataOrderSeller.data.data;
  let html = '';
  let col = 0;
  let first = true;

  dataOrderSeller.forEach(element => {
    if (col == 0) {
      if (!first) {
        html += `</div>`;
      }
      first = false;
      html += `<div class="flex flex-col w-full lg:flex-row mb-3">`;
    }
    col = (col + 1) % 3;
    html += `
    <div class="grid flex-grow card bg-base-200 rounded-box place-items-center">
      <div class="flex flex-col justify-center items-center mb-3">
        <p class="mx-1 my-1">`+ element.maSo + `</p>
        <p class="mx-1 my-1">`+ element.trangThai + `</p>
        <p class="mx-1 my-1">`+ element.tongTien + `</p>
        <p class="mx-1 my-1">`+ element.ngayLap + `</p>
        <p class="mx-1 my-1">`+ element.phiShip + `</p>
        <p class="mx-1 my-1">`+ element.nguoiMua + `</p>
      </div>
    </div>`;
    if (col != 0)
      html += `<div class="divider lg:divider-horizontal"></div>`;
  });

  if (col != 0)
    html += `</div>`;

  orderSeller.innerHTML = html;

  if (col != 0) {
    orderSeller
      .children[orderSeller.children.length - 1]
      .children[
      orderSeller.children[orderSeller.children.length - 1].children.length - 1
    ].remove();
  }
}

async function renderOrderAdmin() {
  let dataOrderAdmin = await axios.get('/donhang/admin');
  dataOrderAdmin = dataOrderAdmin.data.data;
  let html = '';
  let col = 0;
  let first = true;

  dataOrderAdmin.forEach(element => {
    if (col == 0) {
      if (!first) {
        html += `</div>`;
      }
      first = false;
      html += `<div class="flex flex-col w-full lg:flex-row mb-3">`;
    }
    col = (col + 1) % 3;
    html += `
    <div class="grid flex-grow card bg-base-200 rounded-box place-items-center">
      <div class="flex flex-col justify-center items-center mb-3">
        <p class="mx-1 my-1">`+ element.maSo + `</p>
        <p class="mx-1 my-1">`+ element.trangThai + `</p>
        <p class="mx-1 my-1">`+ element.tongTien + `</p>
        <p class="mx-1 my-1">`+ element.ngayLap + `</p>
        <p class="mx-1 my-1">`+ element.phiShip + `</p>
        <p class="mx-1 my-1">`+ element.nguoiMua + `</p>
        <div class="card-actions justify-end">
          <button class="btn-remove btn btn-xs" id=" `+ element.maSo + `">Remove</button>
        </div>
      </div>
    </div>`;
    if (col != 0)
      html += `<div class="divider lg:divider-horizontal"></div>`;
  });


  if (col != 0)
    html += `</div>`;

  orderAdmin.innerHTML = html;

  if (col != 0) {
    orderAdmin
      .children[orderAdmin.children.length - 1]
      .children[
      orderAdmin.children[orderAdmin.children.length - 1].children.length - 1
    ].remove();
  }

  let btnRemove = document.getElementsByClassName('btn-remove');
  for (const element of btnRemove) {
    element.addEventListener('click', () => {
      deleteOrderProduct(element.id);
    }, false);
  }
}

async function renderCart() {
  await getDataCarts();
  let html = '';
  console.log("dataCarts", dataCarts);
  dataCarts.forEach(element => {
    html += `
    <li>
      <label class="flex items-center">
      <input type="checkbox" checked="checked" class="checkbox checkbox-xs checkbox-cart" value="`+ element.maSoGioHang + `" />
      <p class="mx-1 my-1 text-sm">Ma Gio Hang: `+ element.maSoGioHang + `</p>
      </label>
    </li>`;
  });
  carts.innerHTML = html;
}

async function rederCartDetail() {
  await getDataCarts();
  let html = '';
  let total = 0;
  dataCarts.forEach(cartDetails => {
    html += `<h1 class="font-bold text-xl mb-4" name="maGioHang">Order Summary of Cart ` + cartDetails.maSoGioHang + `:</h1>`;

    cartDetails.chiTietGioHang.forEach(element => {
      html += `
      <div class="flex flex-col bg-base-200 rounded-lg mb-5 py-2">
        <div class="flex flex-row justify-center items-center">
          <div class="w-28 m-4">`;

      if (element.sanPham.imgTmps.length > 0)
        html += `<img src="` + element.sanPham.imgTmps[0].path + `" alt="" srcset="">`;

      html += `
        </div>
        <div class="flex flex-row justify-between items-center w-full">
          <div class="flex flex-col">
            <h1 class="text-sm font-bont">`+ element.sanPham.tenSanPham + `</h1>
            <p class="text-xs font-light">Cost</p>
            <h1 class="text-xs font-bont">`+ element.sanPham.giaTri + `$</h1>
          </div>
          <div class="flex justify-center items-center mr-4 flex-col sm:flex-row">
            <button class="btn btn-xs plus">+</button>
            <div class="mx-1">`+ element.soLuong + `</div>
            <button class="btn btn-xs minus">-</button>
            <button class="m-1 btn btn-xs cart-orders-save" name="maGH-`+ cartDetails.maSoGioHang + `-` + element.maSoChiTietGioHang + `-` + element.sanPham.id + `">Save</button>
          </div>
        </div>
      </div>`;

      total += element.sanPham.giaTri * element.soLuong;

    });
    html += `
    <div class="flex flex-col mt-5">
        <div class="flex flex-row justify-between mx-4 mb-2">
          <p>Total</p>
          <p>`+ total + `$</p>
        </div>
        <div class="flex flex-row justify-between mx-4 mb-2">
          <p>Shipping</p>
          <p>30$</p>
        </div>
        
        <button  class="btn btn-sm cart-orders-comfirm" name="maGioHang`+ cartDetails.maSoGioHang + `">Comfirm Order</button>
      </div>
    </div>`;
  });

  cartsDetail.innerHTML = html;

  let comfirms = document.getElementsByClassName('cart-orders-comfirm');
  if (comfirms) {
    for (const element of comfirms) {
      element.onclick = function () {
        element.name = element.name.split('-');
        let idGioHang = Number(element.name[element.name.length - 1]);
        console.log(idGioHang);
        comfirmOrder(idGioHang);
      }
    }
  }

  let saves = document.getElementsByClassName('cart-orders-save');
  if (saves) {
    for (const element of saves) {
      element.onclick = function () {
        let nameArray = element.name.split('-');
        console.log(element.name);
        let idSanPham = Number(nameArray[nameArray.length - 1]);
        let idChiTietGioHang = Number(nameArray[nameArray.length - 2]);
        let gioHangId = Number(nameArray[nameArray.length - 3]);
        let aMount = Number(element.parentNode.children[1].innerText);
        console.log(gioHangId);
        console.log(idSanPham);
        console.log(idChiTietGioHang);
        console.log(aMount);
        saveOrder(idChiTietGioHang, idSanPham, gioHangId, aMount);

      }
    }
  }

  let minus = document.querySelectorAll('.minus');
  if (minus) {
    for (const element of minus) {
      element.addEventListener('click', () => {
        let value = element.parentNode.children[1].innerText;
        if (value > 0) {
          element.parentNode.children[1].innerText--;
        }
      });
    }
  }

  let plus = document.querySelectorAll('.plus');
  if (plus) {
    for (const element of plus) {
      element.addEventListener('click', () => {
        element.parentNode.children[1].innerText++;
      });
    }
  }

}


async function renderProducts(isUser) {
  await getDataProducts(isUser);
  let html = '';

  console.log("dataProduct", dataProduct);

  dataProduct.forEach(categorys => {
    let first = true;
    let col = 0;
    if (categorys.length == 0) {
      return;
    }
    html += `
    <div class="block my-5">
      <h1 class="font-bold sm:text-xl my-3">` + categorys[0].loaiSanPham + `</h1>`;
    categorys.forEach(element => {
      if (col == 0) {
        if (!first) {
          html += `</div>`;
        }
        first = false;
        html += `<div class="flex flex-col xl:flex-row justify-center items-center xl:justify-around">`;
      }

      col = (col + 1) % 3;
      html += `
        <div class="card w-full my-3 lg:my-0 md:w-80 xl:w-48 2xl:w-64 glass">`;

      if (element.imgTmps.length > 0) {
        html += `<figure><img src="` + element.imgTmps[0].path + `"  style="width:auto; height:250px"/></figure>`;
      }

      console.log(url[url.length - 2]);

      let message = "";

      if (url[url.length - 2] == "upload") {
        message = "remove";
      } else {
        message = "add to cart";
      }

      html += `
          <div class="card-body" style="min-height: 8rem; max-height: 15rem;">
            <h2 class="card-title"><a href="/shop/productNS/`+ element.id + `">` + element.tenSanPham + `</a></h2>
            <p class="text-xs">ma SP `+ element.id + `</p>
            <p class="text-xs text-ellipsis overflow-hidden">`+ element.moTa + `</p>
            <p class="text-xs font-bold">`+ element.giaTri + `$</p>
            <div class="card-actions justify-end">
              <button id="`+ element.id + `" class="btn btn-sm add-to-cart">
                `+ message + `
              </button>
            </div>
          </div>
        </div>`;

    });
    if (col != 0) {
      html += `</div>`;
    }
    html += `</div>`;

  });

  products.innerHTML = html;

  let btns = document.getElementsByClassName("add-to-cart");
  for (const element of btns) {
    element.onclick = function () {
      if (url[url.length - 2] != "upload") {
        addToCart(element.id);
      } else {
        deleteProduct(element.id);
      }
    }
  }
}

async function renderProduct(productId) {
  await getDataProduct(productId);
  let htmlImage = '';
  let htmlImageBtn = '';

  let i = 0;
  dataProduct.imgTmps.forEach(element => {
    htmlImage += `
      <div id="item`+ i + `" class="carousel-item w-full">
        <img src="`+ element.path + `" class="w-full" />
      </div>`;
    htmlImageBtn += `
      <a href="#item`+ i + `" class="btn btn-xs">1</a>
    `;
  });

  productImagesButton.innerHTML = htmlImageBtn;
  productImages.innerHTML = htmlImage;

  let html = '';

  html += `
    <div class="rating rating-lg md:rating-md rating-half my-1 ">
      <input type="radio" name="rating-0" class="rating-hidden hidden" />
      <input type="radio" name="rating-0" class="bg-green-500 mask mask-star-2 mask-half-1" />
      <input type="radio" name="rating-0" class="bg-green-500 mask mask-star-2 mask-half-2" />
      <input type="radio" name="rating-0" class="bg-green-500 mask mask-star-2 mask-half-1" />
      <input type="radio" name="rating-0" class="bg-green-500 mask mask-star-2 mask-half-2" />
      <input type="radio" name="rating-0" class="bg-green-500 mask mask-star-2 mask-half-1" />
      <input type="radio" name="rating-0" class="bg-green-500 mask mask-star-2 mask-half-2" />
      <input type="radio" name="rating-0" class="bg-green-500 mask mask-star-2 mask-half-1" />
      <input type="radio" name="rating-0" class="bg-green-500 mask mask-star-2 mask-half-2" />
      <input type="radio" name="rating-0" class="bg-green-500 mask mask-star-2 mask-half-1" />
      <input type="radio" name="rating-0" class="bg-green-500 mask mask-star-2 mask-half-2" />
    </div>
    <h1 class="font-bold sm:text-xl my-1" id="productId"  data-product-id="`+ dataProduct.id + `">` + dataProduct.tenSanPham + `</h1>
    <p class="text-sm my-1">`+ dataProduct.giaTri + `</p>`;
  if (dataProduct.thongSoSanPhams.length > 0) {
    html += `
    <p class="text-sm my-1 font-bold">`+ dataProduct.thongSoSanPhams[0].tenThongSo + `</p>
    <p class="text-sm">`+ dataProduct.thongSoSanPhams[0].chiTiet + `</p>`;
  }
  html += `
    <p class="text-sm my-1 font-bold">Description</p>
    <p class="text-sm">`+ dataProduct.moTa + `</p>
    <button class="btn btn-sm my-3 w-32" id="btn-add-to-cart">Add To Cart</button>
  `;

  product.innerHTML = html;
  console.log(dataProduct.star);
  let star = Math.round(Number(dataProduct.star));
  let ratingRoot = document.getElementsByName("rating-0");
  ratingRoot[star].checked = true;

  let ratingComments = document.getElementById("rating-comments");
  let htmlComment = '';

  i = 12;
  dataProduct.danhGias.forEach(element => {
    htmlComment += `
    <div class="rating rating-md md:rating-sm rating-half my-1 ">
        <input type="radio" name="rating-`+ i + `star" class="rating-hidden" />
        <input type="radio" name="rating-`+ i + `star" class="bg-green-500 mask mask-star-2 mask-half-1" />
        <input type="radio" name="rating-`+ i + `star" class="bg-green-500 mask mask-star-2 mask-half-2" />
        <input type="radio" name="rating-`+ i + `star" class="bg-green-500 mask mask-star-2 mask-half-1" />
        <input type="radio" name="rating-`+ i + `star" class="bg-green-500 mask mask-star-2 mask-half-2" />
        <input type="radio" name="rating-`+ i + `star" class="bg-green-500 mask mask-star-2 mask-half-1" />
        <input type="radio" name="rating-`+ i + `star" class="bg-green-500 mask mask-star-2 mask-half-2" />
        <input type="radio" name="rating-`+ i + `star" class="bg-green-500 mask mask-star-2 mask-half-1" />
        <input type="radio" name="rating-`+ i + `star" class="bg-green-500 mask mask-star-2 mask-half-2" />
        <input type="radio" name="rating-`+ i + `star" class="bg-green-500 mask mask-star-2 mask-half-1" />
        <input type="radio" name="rating-`+ i + `star" class="bg-green-500 mask mask-star-2 mask-half-2" />
      </div>
      <p class="text-sm font-bold">`+ element.khanhHang + `</p>
      <div>`+ element.noiDung + `</div>
      <p class="text-xs font-light">`+ element.ngayDanhGia + `</p>
    </div>`;
    i++;
  });

  ratingComments.innerHTML = htmlComment;



  i = 12;
  dataProduct.danhGias.forEach(element => {
    star = element.star;
    document.getElementsByName("rating-" + i + "star")[star].checked = true;
    console.log(star, i);
    i++;
  });

  let btnAddToCart = document.querySelector('#btn-add-to-cart');
  if (btnAddToCart) {
    btnAddToCart.addEventListener('click', async function () {
      let urlTmp = window.location.href;
      let urlTmpArr = urlTmp.split('/');
      let productId = urlTmpArr[urlTmpArr.length - 1];


      let listCart = document.getElementsByClassName('checkbox-cart');
      if (listCart.length == 0) {
        let icon = `
            <svg xmlns="http://www.w3.org/2000/svg"
            class="stroke-current flex-shrink-0 h-6 w-6"
            fill="none" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          `;
        iconAlert.innerHTML = icon;
        messageAlert.innerText = 'you haven\'t Cart!';
        btnCloseAlert.parentElement.parentElement.classList.add('alert-error');
        btnCloseAlert.parentElement.parentElement.classList.remove('hidden');
      }

      for (const element of listCart) {
        console.log(element.value);
        axios.put('/giohang/' + element.value, { san_pham_id: Number(productId), SoLuong: 1 })
          .then(function (response) {
            console.log(response);
            if (response.status == 200) {
              let icon = `
              <svg xmlns="http://www.w3.org/2000/svg"
              class="stroke-current flex-shrink-0 h-6 w-6"
              fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            `;
              iconAlert.innerHTML = icon;
              messageAlert.innerText = 'Your product has been added to cart!';
              btnCloseAlert.parentElement.parentElement.classList.add('alert-success');
              btnCloseAlert.parentElement.parentElement.classList.remove('hidden');
            }
          }).catch(function (error) {
            console.log(error);
            let icon = `
            <svg xmlns="http://www.w3.org/2000/svg"
            class="stroke-current flex-shrink-0 h-6 w-6"
            fill="none" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          `;
            iconAlert.innerHTML = icon;
            messageAlert.innerText = 'Your product has not been added to cart!';
            btnCloseAlert.parentElement.parentElement.classList.add('alert-error');
            btnCloseAlert.parentElement.parentElement.classList.remove('hidden');
          });
      }
    }, false);
  }

}

async function renderCategoryProductUpload(isEdit) {
  await getDataCategoryProduct();
  let col = 0;
  let first = true;
  let html = '';

  console.log("renderCategoryProductUpload");

  dataCategoryProduct.forEach(element => {
    if (col == 0) {
      if (!first) {

        html += `</div>`;
      }
      first = false;
      html += `<div class="flex flex-col w-full lg:flex-row mb-3">`;
    }
    col = (col + 1) % 3;
    html += `
    <div class="grid flex-grow card bg-base-200 rounded-box place-items-center">
      <div class="flex flex-col justify-center items-center mb-3">
        <p class="mx-1 my-1 text-ellipsis overflow-hidden">`+ element.TenLoaiSanPham + `</p>
        <p class="mx-1 my-1">`+ element.maSo + `</p>`;
    if (isEdit) {
      html += `
      <div class="flex">
        <button class="btn btn-xs btn-remove" id="Remove-`+ element.maSo + `">Remove</button>
      </div>`;
    }
    html += `
      </div>
    </div>`;
    if (col != 0) {
      html += `<div class="divider lg:divider-horizontal"></div>`;
    }
  });

  if (col != 0) {
    html += `</div>`;
  }
  categoryProductsUpload.innerHTML = html;


  if (col != 0) {
    categoryProductsUpload
      .children[categoryProductsUpload.children.length - 1]
      .children[
      categoryProductsUpload.children[categoryProductsUpload.children.length - 1].children.length - 1
    ].remove();
  }

  // let btnRemove = document.getElementsByClassName('btn-remove');
  // for (const element of btnRemove) {
  //   element.addEventListener('click', () => {
  //     deleteOrderProduct(element.id);
  //   }, false);
  // }

  let btnCategoryRemoves = document.getElementsByClassName("btn-remove");
  for (const element of btnCategoryRemoves) {
    element.addEventListener("click", function () {
      let id = element.id.split('-')[1];
      deleteCategoryProduct(id);
    });
  }

}


function comfirmOrder(gioHangId) {
  let radioHinhThucThanhToan = document.getElementsByName('radio-thanhtoan');
  let note = document.getElementById('Note');
  let hinhThucThanhToan = radioHinhThucThanhToan[0].checked ? radioHinhThucThanhToan[0].value : radioHinhThucThanhToan[1].value;



  axios.post('/donhang', { HinhThucThanhToan: hinhThucThanhToan, GhiChu: note.value, gio_hang_id: gioHangId })
    .then(function (response) {
      console.log(response);
      if (response.status == 200) {
        let icon = `
          <svg xmlns="http://www.w3.org/2000/svg"
          class="stroke-current flex-shrink-0 h-6 w-6"
          fill="none" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        `;
        iconAlert.innerHTML = icon;
        messageAlert.innerText = 'Your order has been confirmed!';
        btnCloseAlert.parentElement.parentElement.classList.add('alert-success');
        btnCloseAlert.parentElement.parentElement.classList.remove('hidden');
      }
    }).catch(function (error) {
      console.log(error);
      let icon = `
        <svg xmlns="http://www.w3.org/2000/svg"
        class="stroke-current flex-shrink-0 h-6 w-6"
        fill="none" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      `;
      iconAlert.innerHTML = icon;
      messageAlert.innerText = 'Your order hasn\'t been confirmed!';
      btnCloseAlert.parentElement.parentElement.classList.add('alert-error');
      btnCloseAlert.parentElement.parentElement.classList.remove('hidden');
    });
}

function saveOrder(chiTietGioHangID, idProduct, gioHangId, aMount) {
  axios.put('/chitietgiohang/' + chiTietGioHangID, { san_pham_id: Number(idProduct), SoLuong: Number(aMount), gio_hang_id: gioHangId })
    .then(function (response) {
      console.log(response);
      if (response.status == 200) {
        let icon = `
        <svg xmlns="http://www.w3.org/2000/svg"
        class="stroke-current flex-shrink-0 h-6 w-6"
        fill="none" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      `;
        iconAlert.innerHTML = icon;
        messageAlert.innerText = 'Your order has been saved!';
        btnCloseAlert.parentElement.parentElement.classList.add('alert-success');
        btnCloseAlert.parentElement.parentElement.classList.remove('hidden');
      }
    }).catch(function (error) {
      console.log(error);
      let icon = `
      <svg xmlns="http://www.w3.org/2000/svg"
      class="stroke-current flex-shrink-0 h-6 w-6"
      fill="none" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
    `;
      iconAlert.innerHTML = icon;
      messageAlert.innerText = 'Your order hasn\'t been saved!';
      btnCloseAlert.parentElement.parentElement.classList.add('alert-error');
      btnCloseAlert.parentElement.parentElement.classList.remove('hidden');
    });
  rederCartDetail();
}

function addToCart(idProduct) {
  let listCart = document.getElementsByClassName('checkbox-cart');
  if (listCart.length == 0) {
    let icon = `
        <svg xmlns="http://www.w3.org/2000/svg"
        class="stroke-current flex-shrink-0 h-6 w-6"
        fill="none" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      `;
    iconAlert.innerHTML = icon;
    messageAlert.innerText = 'you haven\'t Cart!';
    btnCloseAlert.parentElement.parentElement.classList.add('alert-error');
    btnCloseAlert.parentElement.parentElement.classList.remove('hidden');
  }

  for (const element of listCart) {
    if (element.checked) {
      axios.put('/giohang/' + element.value, { san_pham_id: Number(idProduct), SoLuong: 1 })
        .then(function (response) {
          console.log(response);
          if (response.status == 200) {
            let icon = `
          <svg xmlns="http://www.w3.org/2000/svg"
          class="stroke-current flex-shrink-0 h-6 w-6"
          fill="none" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        `;
            iconAlert.innerHTML = icon;
            messageAlert.innerText = 'Your order has been saved!';
            btnCloseAlert.parentElement.parentElement.classList.add('alert-success');
            btnCloseAlert.parentElement.parentElement.classList.remove('hidden');
          }
        }).catch(function (error) {
          console.log(error);
          let icon = `
        <svg xmlns="http://www.w3.org/2000/svg"
        class="stroke-current flex-shrink-0 h-6 w-6"
        fill="none" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      `;
          iconAlert.innerHTML = icon;
          messageAlert.innerText = 'Your order hasn\'t been saved!';
          btnCloseAlert.parentElement.parentElement.classList.add('alert-error');
          btnCloseAlert.parentElement.parentElement.classList.remove('hidden');
        });
    }
  }
}

if (createCart) {
  createCart.addEventListener('click', createToCart);
}

if (removeCart) {
  removeCart.addEventListener('click', removeToCart);
}

function createToCart() {
  axios.post('/giohang', {})
    .then(function (response) {
      console.log(response);
      if (response.status == 200) {
        let icon = `
        <svg xmlns="http://www.w3.org/2000/svg"
        class="stroke-current flex-shrink-0 h-6 w-6"
        fill="none" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      `;
        iconAlert.innerHTML = icon;
        messageAlert.innerText = 'Your cart has been created!';
        btnCloseAlert.parentElement.parentElement.classList.add('alert-success');
        btnCloseAlert.parentElement.parentElement.classList.remove('hidden');
      }
    }).catch(function (error) {
      console.log(error);
      let icon = `
      <svg xmlns="http://www.w3.org/2000/svg"
      class="stroke-current flex-shrink-0 h-6 w-6"
      fill="none" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
    `;
      iconAlert.innerHTML = icon;
      messageAlert.innerText = 'Your cart hasn\'t been created!';
      btnCloseAlert.parentElement.parentElement.classList.add('alert-error');
      btnCloseAlert.parentElement.parentElement.classList.remove('hidden');
    });
  renderCart();
}

function removeToCart() {
  let listCart = document.getElementsByClassName('checkbox-cart');
  for (const element of listCart) {
    // console.log(element.value);
    axios.delete('/giohang/' + element.value)
      .then(function (response) {
        console.log(response);
        if (response.status == 200) {
          let icon = `
          <svg xmlns="http://www.w3.org/2000/svg"
          class="stroke-current flex-shrink-0 h-6 w-6"
          fill="none" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        `;
          iconAlert.innerHTML = icon;
          messageAlert.innerText = 'Your cart has been removed!';
          btnCloseAlert.parentElement.parentElement.classList.add('alert-success');
          btnCloseAlert.parentElement.parentElement.classList.remove('hidden');
        }
      }).catch(function (error) {
        console.log(error);
        let icon = `
        <svg xmlns="http://www.w3.org/2000/svg"
        class="stroke-current flex-shrink-0 h-6 w-6"
        fill="none" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      `;
        iconAlert.innerHTML = icon;
        messageAlert.innerText = 'Your cart hasn\'t been removed!';
        btnCloseAlert.parentElement.parentElement.classList.add('alert-error');
        btnCloseAlert.parentElement.parentElement.classList.remove('hidden');
      });
  }
  renderCart();
}


let submitProduct = document.getElementById('submit-product');
let editProduct = document.getElementById('edit-product');


if (submitProduct && editProduct) {
  submitProduct.addEventListener('click', postProduct, false);
  editProduct.addEventListener('click', putProduct, false);
}


function postProduct() {
  let productInfo = document.getElementsByName("product-info");

  let imagesUpload = document.getElementsByTagName('iframe')[0].contentWindow.document.getElementsByTagName("img");
  let imagePath = [];

  for (const element of imagesUpload) {
    let imageSrc = element.src;
    let imagePathSrc = imageSrc.split('/');
    imagePath.push(imagePathSrc[imagePathSrc.length - 1]);
  }

  let dataSend = {
    TenSanPham: productInfo[0].value,
    MoTa: productInfo[1].value,
    GiaTri: Number(productInfo[2].value),
    loai_san_pham_id: productInfo[3].value,
    TenThongSo: productInfo[4].value,
    ChiTietThongSo: productInfo[5].value,
    SoLuong: Number(productInfo[6].value),
    TenKhuyenMai: productInfo[7].value,
    GiamGia: productInfo[8].value,
    NgayBatDau: productInfo[9].value,
    NgayKetThuc: productInfo[10].value,
    HinhAnhs: imagePath,
    Show: 1,
  }
  console.log(dataSend);
  axios.post('/sanpham', dataSend)
    .then(function (response) {
      console.log(response);
      if (response.status == 201) {
        let icon = `
        <svg xmlns="http://www.w3.org/2000/svg"
        class="stroke-current flex-shrink-0 h-6 w-6"
        fill="none" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      `;
        iconAlert.innerHTML = icon;
        messageAlert.innerText = 'Your product has been created!';
        btnCloseAlert.parentElement.parentElement.classList.add('alert-success');
        btnCloseAlert.parentElement.parentElement.classList.remove('hidden');

        document.getElementsByTagName('iframe')[0].contentDocument.body.innerHTML = "";
        document.getElementsByTagName('textarea')[0].value = ""
      }
    }).catch(function (error) {
      console.log(error);
      let icon = `
      <svg xmlns="http://www.w3.org/2000/svg"
      class="stroke-current flex-shrink-0 h-6 w-6"
      fill="none" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
    `;
      iconAlert.innerHTML = icon;
      messageAlert.innerText = 'Your product hasn\'t been created!';
      btnCloseAlert.parentElement.parentElement.classList.add('alert-error');
      btnCloseAlert.parentElement.parentElement.classList.remove('hidden');
    });

}

function putProduct() {
  let productInfo = document.getElementsByName("product-info");

  let imagesUpload = document.getElementsByTagName('iframe')[0].contentWindow.document.getElementsByTagName("img");
  let imagePath = [];

  for (const element of imagesUpload) {
    let imageSrc = element.src;
    let imagePathSrc = imageSrc.split('/');
    imagePath.push(imagePathSrc[imagePathSrc.length - 1]);
  }

  let dataSend = {
    TenSanPham: productInfo[0].value,
    MoTa: productInfo[1].value,
    GiaTri: Number(productInfo[2].value),
    loai_san_pham_id: productInfo[3].value,
    TenThongSo: productInfo[4].value,
    ChiTietThongSo: productInfo[5].value,
    SoLuong: Number(productInfo[6].value),
    TenKhuyenMai: productInfo[7].value,
    GiamGia: productInfo[8].value,
    NgayBatDau: productInfo[9].value,
    NgayKetThuc: productInfo[10].value,
    san_pham_id: productInfo[11].value,
    HinhAnhs: imagePath,
    Show: 1,
  }

  console.log(dataSend);
  axios.put('/sanpham/' + productInfo[11].value, dataSend)
    .then(function (response) {
      console.log(response);
      if (response.status == 200) {
        let icon = `
        <svg xmlns="http://www.w3.org/2000/svg"
        class="stroke-current flex-shrink-0 h-6 w-6"
        fill="none" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      `;
        iconAlert.innerHTML = icon;
        messageAlert.innerText = 'Your product has been updated!';
        btnCloseAlert.parentElement.parentElement.classList.add('alert-success');
        btnCloseAlert.parentElement.parentElement.classList.remove('hidden');
      }
    }).catch(function (error) {
      console.log(error);
      let icon = `
      <svg xmlns="http://www.w3.org/2000/svg"
      class="stroke-current flex-shrink-0 h-6 w-6"
      fill="none" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
    `;
      iconAlert.innerHTML = icon;
      messageAlert.innerText = 'Your product hasn\'t been updated!';
      btnCloseAlert.parentElement.parentElement.classList.add('alert-error');
      btnCloseAlert.parentElement.parentElement.classList.remove('hidden');
    });
}

function deleteProduct(productId) {
  console.log(productId);
  axios.delete('/sanpham/' + productId)
    .then(function (response) {
      console.log(response);
      if (response.status == 200) {
        let icon = `
        <svg xmlns="http://www.w3.org/2000/svg"
        class="stroke-current flex-shrink-0 h-6 w-6"
        fill="none" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      `;
        iconAlert.innerHTML = icon;
        messageAlert.innerText = 'Your product has been deleted!';
        btnCloseAlert.parentElement.parentElement.classList.add('alert-success');
        btnCloseAlert.parentElement.parentElement.classList.remove('hidden');
      }
    }).catch(function (error) {
      console.log(error);
      let icon = `
      <svg xmlns="http://www.w3.org/2000/svg"
      class="stroke-current flex-shrink-0 h-6 w-6"
      fill="none" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
    `;
      iconAlert.innerHTML = icon;
      messageAlert.innerText = 'Your product hasn\'t been deleted!';
      btnCloseAlert.parentElement.parentElement.classList.add('alert-error');
      btnCloseAlert.parentElement.parentElement.classList.remove('hidden');
    });
  let isUser = (url[url.length - 2] == "upload") ? 1 : 0;
  renderProducts(isUser);
}

function postCategoryProduct() {
  let categoryProductInfo = document.getElementsByName("category-product-info");
  let dataSend = {
    TenLoaiSanPham: categoryProductInfo[0].value,
    Show: 1,
  }
  console.log(dataSend);
  axios.post('/loaisanpham', dataSend)
    .then(function (response) {
      console.log(response);
      if (response.status == 200) {
        let icon = `
        <svg xmlns="http://www.w3.org/2000/svg"
        class="stroke-current flex-shrink-0 h-6 w-6"
        fill="none" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      `;
        iconAlert.innerHTML = icon;
        messageAlert.innerText = 'Your category product has been created!';
        btnCloseAlert.parentElement.parentElement.classList.add('alert-success');
        btnCloseAlert.parentElement.parentElement.classList.remove('hidden');
      }
    }).catch(function (error) {
      console.log(error);
      let icon = `
      <svg xmlns="http://www.w3.org/2000/svg"
      class="stroke-current flex-shrink-0 h-6 w-6"
      fill="none" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
    `;
      iconAlert.innerHTML = icon;
      messageAlert.innerText = 'Your category product hasn\'t been created!';
      btnCloseAlert.parentElement.parentElement.classList.add('alert-error');
      btnCloseAlert.parentElement.parentElement.classList.remove('hidden');
    });
  let isEdit = (url[url.length - 1] == "productNS") ? false : true;
  renderCategoryProductUpload(isEdit);
}

function putCategoryProduct() {
  let categoryProductInfo = document.getElementsByName("category-product-info");
  let dataSend = {
    TenLoaiSanPham: categoryProductInfo[0].value,
    loai_san_pham_id: categoryProductInfo[1].value,
    Show: 1,
  }
  console.log(dataSend);
  axios.put('/loaisanpham/' + categoryProductInfo[1].value, dataSend)
    .then(function (response) {
      console.log(response);
      if (response.status == 200) {
        let icon = `
        <svg xmlns="http://www.w3.org/2000/svg"
        class="stroke-current flex-shrink-0 h-6 w-6"
        fill="none" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      `;
        iconAlert.innerHTML = icon;
        messageAlert.innerText = 'Your category product has been updated!';
        btnCloseAlert.parentElement.parentElement.classList.add('alert-success');
        btnCloseAlert.parentElement.parentElement.classList.remove('hidden');
      }
    }).catch(function (error) {
      console.log(error);
      let icon = `
      <svg xmlns="http://www.w3.org/2000/svg"
      class="stroke-current flex-shrink-0 h-6 w-6"
      fill="none" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
    `;
      iconAlert.innerHTML = icon;
      messageAlert.innerText = 'Your category product hasn\'t been updated!';
      btnCloseAlert.parentElement.parentElement.classList.add('alert-error');
      btnCloseAlert.parentElement.parentElement.classList.remove('hidden');
    });
  let isEdit = (url[url.length - 1] == "productNS") ? false : true;
  renderCategoryProductUpload(isEdit);
}

function deleteCategoryProduct(productId) {
  console.log(productId);
  axios.delete('/loaisanpham/' + productId)
    .then(function (response) {
      console.log(response);
      if (response.status == 200) {
        let icon = `
        <svg xmlns="http://www.w3.org/2000/svg"
        class="stroke-current flex-shrink-0 h-6 w-6"
        fill="none" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      `;
        iconAlert.innerHTML = icon;
        messageAlert.innerText = 'Your category product has been deleted!';
        btnCloseAlert.parentElement.parentElement.classList.add('alert-success');
        btnCloseAlert.parentElement.parentElement.classList.remove('hidden');
      }
    }).catch(function (error) {
      console.log(error);
      let icon = `
      <svg xmlns="http://www.w3.org/2000/svg"
      class="stroke-current flex-shrink-0 h-6 w-6"
      fill="none" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
    `;
      iconAlert.innerHTML = icon;
      messageAlert.innerText = 'Your category product hasn\'t been deleted!';
      btnCloseAlert.parentElement.parentElement.classList.add('alert-error');
      btnCloseAlert.parentElement.parentElement.classList.remove('hidden');
    });

  let isEdit = (url[url.length - 1] == "productNS") ? false : true;
  renderCategoryProductUpload(isEdit);
}

let updateOrderSubmit = document.getElementById('update-order-submit');
if (updateOrderSubmit) {
  updateOrderSubmit.addEventListener('click', putOrderProduct, false);
}


function putOrderProduct() {
  let orderProductInfo = document.getElementsByName("order-product-info");
  let dataSend = {
    order_id: orderProductInfo[0].value,
    TrangThai: orderProductInfo[1].value,
    Show: 1,
  }
  console.log(dataSend);
  axios.put('/donhang/' + orderProductInfo[0].value, dataSend)
    .then(function (response) {
      console.log(response);
      if (response.status == 200) {
        let icon = `
        <svg xmlns="http://www.w3.org/2000/svg"
        class="stroke-current flex-shrink-0 h-6 w-6"
        fill="none" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      `;
        iconAlert.innerHTML = icon;
        messageAlert.innerText = 'Your order product has been updated!';
        btnCloseAlert.parentElement.parentElement.classList.add('alert-success');
        btnCloseAlert.parentElement.parentElement.classList.remove('hidden');
      }
    }).catch(function (error) {
      console.log(error);
      let icon = `
      <svg xmlns="http://www.w3.org/2000/svg"
      class="stroke-current flex-shrink-0 h-6 w-6"
      fill="none" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
    `;
      iconAlert.innerHTML = icon;
      messageAlert.innerText = 'Your order product hasn\'t been updated!';
      btnCloseAlert.parentElement.parentElement.classList.add('alert-error');
      btnCloseAlert.parentElement.parentElement.classList.remove('hidden');
    });
  if (orderAdmin) {
    renderOrderAdmin();
  }
  if (orderSeller) {
    renderOrderSeller();
  }
}

function deleteOrderProduct(orderId) {
  console.log(orderId);
  axios.delete('/donhang/' + Number(orderId))
    .then(function (response) {
      console.log(response);
      if (response.status == 200) {
        let icon = `
        <svg xmlns="http://www.w3.org/2000/svg"
        class="stroke-current flex-shrink-0 h-6 w-6"
        fill="none" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      `;
        iconAlert.innerHTML = icon;
        messageAlert.innerText = 'Your order product has been deleted!';
        btnCloseAlert.parentElement.parentElement.classList.add('alert-success');
        btnCloseAlert.parentElement.parentElement.classList.remove('hidden');
      }
    }).catch(function (error) {
      console.log(error);
      let icon = `
      <svg xmlns="http://www.w3.org/2000/svg"
      class="stroke-current flex-shrink-0 h-6 w-6"
      fill="none" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
    `;
      iconAlert.innerHTML = icon;
      messageAlert.innerText = 'Your order product hasn\'t been deleted!';
      btnCloseAlert.parentElement.parentElement.classList.add('alert-error');
      btnCloseAlert.parentElement.parentElement.classList.remove('hidden');
    });
  renderOrderAdmin();
}