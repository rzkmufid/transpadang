$(document).ready(function () {
  var headings = ["Heading 1", "Heading 2", "Heading 3"];
  var currentHeadingIndex = 0;

  $("#left-arrow").click(function () {
    currentHeadingIndex = (currentHeadingIndex - 1 + headings.length) % headings.length;
    $("#heading").text(headings[currentHeadingIndex]);
  });

  $("#right-arrow").click(function () {
    currentHeadingIndex = (currentHeadingIndex + 1) % headings.length;
    $("#heading").text(headings[currentHeadingIndex]);
  });
});

$(document).ready(function () {
  var products = [
    { imgSrc: "img/7.png", title: "Product 1", price: "190.99" },
    { imgSrc: "img/7.png", title: "Product 2", price: "290.99" },
    { imgSrc: "img/7.png", title: "Product 3", price: "390.99" },
    { imgSrc: "img/7.png", title: "Product 4", price: "490.99" },
  ];

  var productContainer = $("#product-container");

  products.forEach(function (product) {
    var cardHtml = `
      <div class="col-md-3 mb-4">
        <img src="${product.imgSrc}" class="card-img-top" alt="${product.title}">
        <div class="card-body">
          <h5 class="card-title">${product.title}</h5>
          <div class="d-flex justify-content-between">
            <div class="price">Rp(${product.price})</div>
            <button class="btn btn-primary buy-now-btn">
              <i class="fa-solid fa-cart-shopping"></i> 
              <a class="text-login" href="login2.html">Add</a>
            </button>
          </div>
        </div>
      </div>
    `;

    productContainer.append(cardHtml);
  });
});

$(document).ready(function () {
  setTimeout(function () {
    $(".chat-room").addClass("open");
  }, 3000);

  $(".btn-close").on("click", function () {
    $(".chat-room").removeClass("open");
  });
});
