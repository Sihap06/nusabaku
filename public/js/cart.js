// add product to cart

(function () {

    const cartBtn = document.querySelectorAll('.add-to-cart');
    // console.log(cartBtn);

    cartBtn.forEach(function (btn) {
        btn.addEventListener('click', function (event) {
            // console.log(event.target);

            if (event.target.parentElement.classList.contains('add-to-cart')) {
                var shopItem = btn.parentElement.parentElement.parentElement.parentElement;
                var title = shopItem.getElementsByClassName('product-name')[0].innerText;
                var price = shopItem.getElementsByClassName('price')[0].innerText;

                var imageItem = btn.parentElement.parentElement.parentElement.parentElement.parentElement;
                let image = imageItem.getElementsByClassName('img-product')[0].src;

                const item = {};
                item.img = image;
                item.title = title;

                let finalPrice = price.slice(3).trim(1);

                item.price = finalPrice;

                // console.log(item);

                var cartRow = document.createElement('tbody');
                cartRow.classList.add('cart-item');
                // var cartItem = document.getElementsByClassName('cart-item')[0]
                var cartContents = `
                <tr class="text-center">
                <td class="product-remove">
                <a class="hapus-product" href="#"><span class="ion-ios-close"></span></a>
                </td>
                
                <td class="image-prod">
                <img src="${item.img}" alt="" width="100">
                </td>
                
                <td class="product-name">
                <h3>${item.title}</h3>
                
                </td>
                
                <td class="cart-price">Rp. ${item.price}</td>
                
                <td class="quantity">
                10
                </td>
                <td class="total">Rp. 10</td>
                </tr><!-- END TR-->
                `;
                cartRow.innerHTML = cartContents
                var cart = document.getElementById('cart');
                const total = document.querySelector('.cart-total')
                // var newRow = cart.insertRow(1);
                // var newCell = newRow.insertCell(0);
                // var newTbody = document.createElement('tbody');

                // console.log(cart);

                cart.appendChild(cartRow, total);

                alert('produk berhasil di masukkan ke keranjng')

                showTotals();
                removeCart();

            }

        });
    });

    //remove cart
    function removeCart() {
        const removeBtn = document.getElementsByClassName('hapus-product');
        for (var i = 0; i < removeBtn.length; i++) {
            var button = removeBtn[i];
            button.addEventListener('click', function (event) {
                var buttonClicked = event.target;
                buttonClicked.parentElement.parentElement.parentElement.remove();


            })
        }
    }


    //show Total
    function showTotals() {

        const total = [];
        const items = document.querySelectorAll('.cart-price');

        items.forEach(function (item) {
            total.push(parseFloat(item.textContent.slice(3).trim(3)));
        });

        const totalMoney = total.reduce(function (total, item) {
            total += item;
            return total;
        })

        // console.log(totalMoney);

        // var sum = document.querySelector('.cart-subtotal').textContent = totalMoney;
        // document.getElementById('')
        // console.log(totalMoney)

    }

})();

// function addItemToCart(image, title, price) {

//     var cartRow = document.createElement('table')
//     cartRow.classList.add('cart-list')
//     var cartItem = document.getElementsByClassName('cart-item')[0]
//     var cartContents = `
//     <tbody class="cart-item">
//     {{-- @foreach ($orders as $order)
//     @foreach ($order['products'] as $data) --}}

//     <tr class="text-center">
//       <td class="product-remove">
//         {{-- <form action="/hapuscart/{{$order->id}}" method="POST"> --}}
//           {{-- {{ method_field('DELETE') }} --}}
//           @csrf
//           <button type="submit"><span class="ion-ios-close"></span></button>
//       </form>
//       </td>

//       <td class="product-name">
//         <h3>tahu</h3>
//         <p>enak</p>
//       </td>

//       <td class="price">Rp. 10</td>

//       <td class="quantity">
//         {{-- {{$order['quantity']}} --}}
//         10
//       </td>
//       <td class="total">Rp. 10</td>
//     </tr><!-- END TR-->

//     {{-- @endforeach
//     @endforeach --}}

//   </tbody>
//     `
//     cartRow.innerHTML = cartContents
//     cartItem.append(cartRow)

// }

// var removeCartItemButtons = document.getElementsByClassName('hapus-product');
// console.log(removeCartItemButtons);
