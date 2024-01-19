
const number = document.querySelectorAll('.inc-num')

const sumNumber = (mainCart) => {
    if (mainCart) {
        const sum = mainCart.reduce((accumulator, currentValue) => {
            return accumulator + currentValue.qty;
        }, 0);
        number.forEach(item => {
            item.textContent = sum
        })
    }
    else {
        number.forEach(item => {
            item.textContent = 0
        })
    }
}

function redirectToHome() {
    // check any length

    const checkLength = JSON.parse(localStorage.getItem('cart').length > 0);
    if (!localStorage.getItem('cart')) {
        if (window.location.pathname.includes('checkout')) {
            window.location.href = '/';
        }
    }


    else {
        if (!checkLength) {
            if (window.location.pathname.includes('checkout')) {
                window.location.href = '/';
            }
        }
    }
}




const displayProducts = (data) => {
    let mainCart = [];
    const product = {
        id: data.id,
        product_code: data.product_code,
        qty: 1,
        name: data.name,
        images: data.images,
        price: data.price,
    }

    var cartExist = JSON.parse(localStorage.getItem('cart'));

    if (!cartExist) {
        mainCart.push(product)
    } else {
        const checkProductAlreadyExist = cartExist.filter((item, index) => { return item.id === data.id })
        console.log(checkProductAlreadyExist, 'is esit')
        if (checkProductAlreadyExist.length > 0) {
            cartExist.filter((item, index) => {
                if (item.id === data.id) { cartExist[index].qty = cartExist[index].qty + 1; }
            })
            mainCart = cartExist;
        } else {
            mainCart.push(...cartExist, product);
            console.log(mainCart)
        }
    }

    localStorage.setItem('cart', JSON.stringify(mainCart));

    sumNumber(mainCart)
}




const addToCart = (id) => {
    const item = clickOpenCheckoutCanvas();
    item.add();
    fetch(`/products/fetch/${id}`)
        .then(response => {
            if (!response.ok) {
                throw new Error(`Network response was not ok: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            // Handle the fetched products
            displayProducts(data.data);
            item.add();
            cartLoader();
        })
        .catch(error => {
            console.error('Error fetching products:', error);
        });
}





var cartSum = JSON.parse(localStorage.getItem('cart'));

sumNumber(cartSum)
const cartLoader = () => {
    var cartSumMain = JSON.parse(localStorage.getItem('cart'));
    const container = document.querySelectorAll('.cart-main')

    container.forEach(elem => {
        elem.innerHTML = '';
        cartSumMain && cartSumMain.forEach(data => {
            // Create a container div for each data item
            const itemContainer = document.createElement('div');
            const imagesElement = document.createElement('div');
            const contentElement = document.createElement('div');
            const actionElement = document.createElement('div');

            itemContainer.classList.add('main-cart-wrapper')
            imagesElement.classList.add('image-cart-wrapper')
            contentElement.classList.add('content-cart-wrapper')
            actionElement.classList.add('action-cart-wrapper')

            //append wrapper
            itemContainer.appendChild(imagesElement);
            itemContainer.appendChild(contentElement);
            itemContainer.appendChild(actionElement);


            //append for title
            const nameElement = document.createElement('p');
            nameElement.textContent = `Name: ${data.name}`;
            contentElement.appendChild(nameElement);

            //append for qty
            const qtyElement = document.createElement('p');
            qtyElement.textContent = `Qty: ${data.qty}`;
            contentElement.appendChild(qtyElement);

            const imgElement = document.createElement('img');
            imgElement.src = `/storage/${data.images}`;
            imgElement.alt = 'Image';
            imagesElement.appendChild(imgElement);


            // Dynamically create and append increment and decrement buttons
            const incrementButton = document.createElement("button");
            incrementButton.textContent = "Increment";
            incrementButton.classList.add('main-cart-wrapper-inc')
            incrementButton.addEventListener("click", () => increment(data.id));

            const decrementButton = document.createElement("button");
            decrementButton.textContent = "Decrement";
            decrementButton.classList.add('main-cart-wrapper-dec')
            decrementButton.addEventListener("click", () => decrement(data.id));

            const deleteButton = document.createElement("button");
            deleteButton.textContent = "delete";
            deleteButton.classList.add('main-cart-wrapper-del')
            deleteButton.addEventListener("click", () => deleteItem(data.id));

            actionElement.appendChild(decrementButton);
            actionElement.appendChild(incrementButton);
            contentElement.appendChild(deleteButton);






            elem.appendChild(itemContainer);
        });
    })


}





const increment = (id) => {

    let mainCart = [];
    var cartExist = JSON.parse(localStorage.getItem('cart'));

    cartExist.filter((item, index) => {
        if (cartExist[index].qty > 0) {
            if (item.id === id) { cartExist[index].qty = cartExist[index].qty + 1; }
        }
    })

    mainCart = cartExist;
    localStorage.setItem('cart', JSON.stringify(mainCart));
    cartLoader()
    sumNumber(cartExist)


}
const decrement = (id) => {
    let mainCart = [];
    var cartExist = JSON.parse(localStorage.getItem('cart'));

    cartExist.filter((item, index) => {
        if (cartExist[index].qty > 1) {
            if (item.id === id) { cartExist[index].qty = cartExist[index].qty - 1; }
        }
    })

    mainCart = cartExist;
    localStorage.setItem('cart', JSON.stringify(mainCart));
    cartLoader()
    sumNumber(cartExist)

}
const deleteItem = (id) => {
    let mainCart = [];
    var cartExist = JSON.parse(localStorage.getItem('cart'));
    mainCart = cartExist.filter((item, index) => item.id !== id)
    localStorage.setItem('cart', JSON.stringify(mainCart));
    cartLoader()
    sumNumber(JSON.parse(localStorage.getItem('cart')))

}




const clickOpenCheckoutCanvas = () => {




    const cart_icon = document.querySelector('.cart-icon')
    const offset_wrapper = document.querySelector('.offset-wrapper')
    const offset_overlay = document.querySelector('.offset-overlay')
    const offset_close = document.querySelector('.offset-close')


    const add = () => {
        offset_wrapper.classList.add('active')
        offset_overlay.classList.add('active')
    }

    const remove = () => {
        offset_wrapper.classList.remove('active')
        offset_overlay.classList.remove('active')
    }

    cart_icon.addEventListener('click', add)

    offset_overlay.addEventListener('click', remove)

    // offset_close.addEventListener('click', remove)
    return {
        add,
        remove
    }
}






// form validation

function focusScroll(input) {
    input.focus();
    input.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

function validateForm() {





    var form = document.getElementById("checkoutFrom");

    // Prevent the default form submission and handle it in your custom way
    form.addEventListener('submit', function (event) {
        event.preventDefault();

        //code

        // Reset error messages
        document.querySelectorAll('.error').forEach(error => error.textContent = '');

        let isValid = true;

        // Validate name ---- start
        const nameInput = document.getElementById('nameField').value;
        var nameRegex = /^[A-Za-z]+(?: [A-Za-z]+)*$/;

        if (nameInput === '') {
            document.getElementById('nameError').textContent = 'Please enter your name.';
            isValid = false;
        }

        if (!nameRegex.test(nameInput) && nameInput !== '') {
            document.getElementById('nameError').textContent = 'Please enter a valid name.';
            isValid = false;
        }

        // Validate name ---- end


        // Validate mobile number --- start
        const mobileInput = document.getElementById('numberField').value;
        // var phoneNumberRegex = /^\+(?:[0-9] ?){6,14}[0-9]$/;
        const phoneRegex = /^(\+\d{1,2})?\d{10,}$/;

        if (mobileInput === '') {
            document.getElementById('errorNumber').textContent = 'Please enter your name.';
            isValid = false;
        }
        if (!phoneRegex.test(mobileInput) && mobileInput !== '') {
            document.getElementById('errorNumber').textContent = 'Please enter a valid mobile number.';
            isValid = false;
        }

        // Validate mobile number --- end

        // Validate country --- start
        const countryInput = document.getElementById('countryField').value;
        var nameRegex = /^[A-Za-z]+(?: [A-Za-z]+)*$/;
        if (countryInput === '') {
            document.getElementById('countryError').textContent = 'Please enter country.';
            isValid = false;
        }


        if (!nameRegex.test(countryInput) && countryInput !== '') {
            document.getElementById('countryError').textContent = 'Please enter a valid country.';
            isValid = false;
        }

        // Validate country --- end

        // Validate address
        const addressInput = document.getElementById('addressField').value;
        // var nameRegex = /^[A-Za-z]+(?: [A-Za-z]+)*$/;
        if (addressInput === '') {
            document.getElementById('addressError').textContent = 'Please enter address.';
            isValid = false;
        }


        // if (!nameRegex.test(addressInput) && addressInput !== '') {
        //     document.getElementById('addressError').textContent = 'Please enter a valid Address.';
        //     isValid = false;
        // }



        // Validate city
        const cityInput = document.getElementById('cityField').value;
        var nameRegex = /^[A-Za-z]+(?: [A-Za-z]+)*$/;
        if (cityInput === '') {
            document.getElementById('cityError').textContent = 'City required.';
            isValid = false;
        }


        if (!nameRegex.test(cityInput) && cityInput !== '') {
            document.getElementById('cityError').textContent = 'Please enter a valid city.';
            isValid = false;
        }


        // Validate state
        const stateInput = document.getElementById('stateField').value;
        var nameRegex = /^[A-Za-z]+(?: [A-Za-z]+)*$/;
        if (stateInput === '') {
            document.getElementById('stateError').textContent = 'State required.';
            isValid = false;
        }


        if (!nameRegex.test(stateInput) && stateInput !== '') {
            document.getElementById('stateError').textContent = 'Please enter a valid state.';
            isValid = false;
        }


        // Validate pin
        const pinInput = document.getElementById('pinField').value;
        const pinRegex = /^\d{6}$/;
        if (pinInput === '') {
            document.getElementById('pinError').textContent = 'PIN required.';
            isValid = false;
        }


        if (!pinRegex.test(pinInput) && pinInput !== '') {
            document.getElementById('pinError').textContent = 'Please enter a valid PIN.';
            isValid = false;
        }


        // Validate available time
        const availInput = document.getElementById('availField').value;

        if (availInput === '') {
            document.getElementById('availError').textContent = 'Available time required.';
            isValid = false;
        }


        // Validate email

        const mailInput = document.getElementById('emailField').value;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;



        if (mailInput === '') {
            document.getElementById('mailError').textContent = 'mailable time required.';
            isValid = false;
        }

        if (!emailRegex.test(mailInput) && mailInput !== '') {
            document.getElementById('mailError').textContent = 'Please enter a valid email address.';
            isValid = false;
        }


        let itemError = []
        const errorItem = document.querySelectorAll(`span.error`).forEach(element => {
            if (element.innerHTML !== '') {
                itemError.push(element)
            }
        });

        if (itemError.length > 0) {
            focusScroll(itemError[0].parentElement.children[0])

            console.log(itemError)
        }




        // // If form is valid, make a POST request
        if (isValid) {
            var jsonData = {};
            const formData = new FormData(document.getElementById('checkoutFrom'));
            formData.forEach(function (value, key) {
                jsonData[key] = value;
            });
            // console.log(formData)
            formData.forEach((value, key) => {
                console.log(`${key}: ${value}`);
            });

            const listed_products = localStorage.getItem('cart');

            const dataMain = { ...jsonData, products: listed_products }
            console.log(dataMain)
            fetch('/place-order', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': main_token
                },
                body: JSON.stringify(dataMain)
            })
                .then(response => response.json())
                .then(data => {
                    // Handle the response from the server
                    if (data?.status === "success") {
                        localStorage.removeItem('cart');
                        window.location.href = '/success';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    });
}



const productSlider = () => {
    const swiper = new Swiper('.swiper', {
        // Optional parameters
        loop: true,

        // If we need pagination
        pagination: {
            el: '.swiper-pagination',
        },

        // Navigation arrows
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },


    });
}








function validateFormService() {





    var form = document.getElementById("serviceFrom");

    // Prevent the default form submission and handle it in your custom way
    form.addEventListener('submit', function (event) {
        event.preventDefault();

        //code

        // Reset error messages
        document.querySelectorAll('.error').forEach(error => error.textContent = '');

        let isValid = true;

        // Validate name ---- start
        const nameInput = document.getElementById('nameField').value;
        var nameRegex = /^[A-Za-z]+(?: [A-Za-z]+)*$/;

        if (nameInput === '') {
            document.getElementById('nameError').textContent = 'Please enter your name.';
            isValid = false;
        }

        if (!nameRegex.test(nameInput) && nameInput !== '') {
            document.getElementById('nameError').textContent = 'Please enter a valid name.';
            isValid = false;
        }

        // Validate name ---- end


        // Validate mobile number --- start
        const mobileInput = document.getElementById('numberField').value;
        // var phoneNumberRegex = /^\+(?:[0-9] ?){6,14}[0-9]$/;
        const phoneRegex = /^(\+\d{1,2})?\d{10,}$/;

        if (mobileInput === '') {
            document.getElementById('errorNumber').textContent = 'Please enter your number.';
            isValid = false;
        }
        if (!phoneRegex.test(mobileInput) && mobileInput !== '') {
            document.getElementById('errorNumber').textContent = 'Please enter a valid mobile number.';
            isValid = false;
        }




        // Validate address
        const addressInput = document.getElementById('addressField').value;
        // var nameRegex = /^[A-Za-z]+(?: [A-Za-z]+)*$/;
        if (addressInput === '') {
            document.getElementById('addressError').textContent = 'Please enter address.';
            isValid = false;
        }




        // Validate address
        const serviceInput = document.getElementById('serviceField').value;
        // var nameRegex = /^[A-Za-z]+(?: [A-Za-z]+)*$/;
        if (serviceInput === '') {
            document.getElementById('serviceError').textContent = 'Please enter service.';
            isValid = false;
        }


        // if (!nameRegex.test(addressInput) && addressInput !== '') {
        //     document.getElementById('addressError').textContent = 'Please enter a valid Address.';
        //     isValid = false;
        // }





        // Validate email

        const mailInput = document.getElementById('emailField').value;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;



        if (mailInput === '') {
            document.getElementById('mailError').textContent = 'mail required.';
            isValid = false;
        }

        if (!emailRegex.test(mailInput) && mailInput !== '') {
            document.getElementById('mailError').textContent = 'Please enter a valid email address.';
            isValid = false;
        }


        let itemError = []
        const errorItem = document.querySelectorAll(`span.error`).forEach(element => {
            if (element.innerHTML !== '') {
                itemError.push(element)
            }
        });

        if (itemError.length > 0) {
            focusScroll(itemError[0].parentElement.children[0])

            console.log(itemError)
        }




        // // If form is valid, make a POST request
        if (isValid) {
            var jsonData = {};
            const formData = new FormData(document.getElementById('checkoutFrom'));
            formData.forEach(function (value, key) {
                jsonData[key] = value;
            });
            // console.log(formData)
            formData.forEach((value, key) => {
                console.log(`${key}: ${value}`);
            });

            const listed_products = localStorage.getItem('cart');

            const dataMain = { ...jsonData, products: listed_products }
            console.log(dataMain)
            fetch('/place-order', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': main_token
                },
                body: JSON.stringify(dataMain)
            })
                .then(response => response.json())
                .then(data => {
                    // Handle the response from the server
                    if (data?.status === "success") {
                        localStorage.removeItem('cart');
                        window.location.href = '/success';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    });
}



function openModelService() {

    const enq_btn = document.querySelector('.enq-btn');
    const enq_inner = document.querySelector('.enq-inner');
    const enq_wrapper_overlay = document.querySelector('.enq-wrapper-overlay');
    const enq_close = document.querySelector('.enq-close');



    enq_btn?.addEventListener('click', () => {
        enq_inner.classList.add('active')
        enq_wrapper_overlay.classList.add('active')
    })


    enq_wrapper_overlay?.addEventListener('click', () => {
        enq_inner.classList.remove('active')
        enq_wrapper_overlay.classList.remove('active')
    })

    enq_close?.addEventListener('click', () => {
        enq_inner.classList.remove('active')
        enq_wrapper_overlay.classList.remove('active')
    })

}




cartLoader();
clickOpenCheckoutCanvas();
redirectToHome();
productSlider();
openModelService();