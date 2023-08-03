<html lang="en">
<style>
    @import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');

    /* * {
        font-family: 'Lato', sans-serif;
        outline: 1px solid red;

    } */
</style>
<title>Home</title>
<script src="https://cdn.tailwindcss.com"></script>

<?php
require_once __DIR__ . '/../header.php';
generateHeader('home', 'dark');

if (isset($_SESSION['USER_ID'])) {
    echo '<input type="hidden" id="userId" value="' . $_SESSION['USER_ID'] . '"></input>';
}
else{
    echo '<input type="hidden" id="userId" value="' . $_SESSION['TEMP_ID'] . '"></input>';
}
?>

<body>
    <div class="w-full h-full flex items-center justify-center" id="wrapper">

        <div class=" w-[900px] h-10% flex flex-col justify-center items-center">
            <p class="ticket">
            <h1 class="text-4xl py-4">Your shopping cart</h1>
            <div class="overflow-y w-full">
                <table class="text-left w-full">
                    <tbody class="bg-grey-light flex flex-col items-center overflow-y-scroll w-full h-[500px] gap-[50px]" id="tickets">
                    </tbody>
                </table>
            </div>
            </p>

            <div class="absolute-bottom w-full flex flex-row gap-8 py-8">
                <span class="p-auto text-[20px] ml-auto w-fit">sub-total:<p id="subTotalCount"></p>
                </span>
                <span class="p-auto text-[20px] w-fit">total:<p id="totalCount"></p>
                </span>
                <button class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-6 border-b-4 border-blue-700 hover:border-blue-500 rounded" onclick="checkout()">
                    Checkout
                </button>
                
                <button class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-6 border-b-4 border-blue-700 hover:border-blue-500 rounded" onclick="share()">
                    Share
                </button>
            </div>

        </div>
</body>


<script>
    let euro = Intl.NumberFormat('en-DE', {
        style: 'currency',
        currency: 'EUR',
    });

    totalAmount = 0;
    subTotalAmount = 0;
    async function getShoppingCartItems(id) {
        const res = await fetch('http://localhost/api/cart?id=' + id);
        const data = await res.json();
        return data;
    }

    async function loadCart() {
        items = await getShoppingCartItems(getId());
        ticketWrapper = document.getElementById('tickets');
        ticketWrapper.innerHTML = "";
        for (let i = 0; i < items.length; i++) {
            switch (items[i].session_type) {
                case "yummie":
                    generateYummieCartObject(items[i], ticketWrapper);
                    break;
                case "edm":
                    generateEDMCartObject(items[i], ticketWrapper);
                    break;
                case "stroll":
                    generateStrollCartObject(items[i], ticketWrapper);
                    break;

                default:
                    break;
            }
        }

        loadTotal();
    }

    function loadTotal() {
        subtotal = document.getElementById('subTotalCount');
        subtotal.innerHTML = euro.format(subTotalAmount);

        total = document.getElementById('totalCount');
        total.innerHTML = euro.format(totalAmount);
    }

    function getRestaurant(id) {
        return new Promise((resolve, reject) => {
            fetch('http://localhost/api/restaurants')
                .then((response) => response.json())
                .then((data) => {
                    const restaurant = data.find((r) => {
                        return (
                            r.id == id
                        );
                    });
                    resolve(restaurant);
                    return restaurant;
                })
                .catch((error) => {
                    console.log(error);
                });
        });
    }

    function getVenue(id) {
        return new Promise((resolve, reject) => {
            fetch('http://localhost/api/dancelocations')
                .then((response) => response.json())
                .then((data) => {
                    const location = data.find((l) => {
                        return (
                            l.id == id
                        );
                    });
                    resolve(location);
                    return location;
                })
                .catch((error) => {
                    console.log(error);
                });
        });
    }

    function getArtist(id) {
        return new Promise((resolve, reject) => {
            fetch('http://localhost/api/artists')
                .then((response) => response.json())
                .then((data) => {
                    const artist = data.find((a) => {
                        return (
                            a.id == id
                        );
                    });
                    resolve(artist);
                    return artist;
                })
                .catch((error) => {
                    console.log(error);
                });
        });
    }

    async function removeTicket(target) {
        data = {
            post_type: "delete",
            id: target.currentTarget.myParam
        }
        fetch('http://localhost/api/tickets', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'application/json',
            },
            redirect: 'follow',
            referrerPolicy: 'no-referrer',
            body: JSON.stringify(data),
        });
        setTimeout(() => {
            loadCart();
        }, "500");
    }

    function generateYummieCartObject(item, parent) {

        getRestaurant(item.session.restaurant_id).then(r => {
            date = item.session.session_date + ' ' + item.session.session_startTime;
            generateCartObject(item.id, r.name, r.address, date, 1, item.price, parent);
        });

        subTotalAmount += item.price;
        totalAmount += item.price + (item.price * 0.09);
    }

    function generateEDMCartObject(item, parent) {
        getVenue(item.session.venue).then(v => {
            getArtist(item.session.artist_id).then(a => {
                generateCartObject(item.id, v.name, a.name, item.session.date, 1, item.price, parent);
            })

        })


        subTotalAmount += item.price;
        totalAmount += item.price + (item.price * 0.21);
    }

    function generateStrollCartObject(item, parent) {
        subTitle = "Language: " + item.session.language;
        generateCartObject(item.id, "Stroll through Haarlem", subTitle, item.session.date, 1, item.price, parent);

        subTotalAmount += item.price;
        totalAmount += item.price + (item.price * 0.21);
    }

    function getId() {
        id = document.getElementById("userId").value;
        return id;
    }

    function generateCartObject(id, title, subTitle, date, qty, priceTag, parent) {
        fullWrapper = document.createElement('div');
        fullWrapper.classList.add("bg-[#F7F7FB]", "p-4", "rounded-md", "w-full", "h-fit", "flex", "flex-row")

        wrapperLeft = document.createElement("div");
        wrapperLeft.classList.add("w-[70%]", "flex", "flex-col", "gap-2");
        titleSpan = document.createElement("h1");
        titleSpan.innerHTML = title;
        titleSpan.classList.add("bold", "text-[20px]");
        secondTitle = document.createElement("h2");
        secondTitle.innerHTML = subTitle;


        timeTitle = document.createElement("span");
        timeTitle.innerHTML = "starting time:";
        timeSpan = document.createElement("span");
        timeSpan.classList.add("text-[25px]")
        timeSpan.innerHTML = date;

        qty = document.createElement("span");
        qty.innerHTML = "Qty: " + 1;

        price = document.createElement("span");
        price.innerHTML = euro.format(priceTag);

        wrapperLeft.appendChild(titleSpan);
        wrapperLeft.appendChild(secondTitle);
        wrapperLeft.appendChild(timeTitle);
        wrapperLeft.appendChild(timeSpan);
        wrapperLeft.appendChild(qty);
        wrapperLeft.appendChild(price)


        wrapperRight = document.createElement("div");
        wrapperRight.classList.add("w-auto", "flex", "items-center", "justify-items-end", "gap-8")

        remove = document.createElement("button");
        remove.innerHTML = "remove";
        remove.addEventListener("click", removeTicket, false);
        remove.myParam = id;


        wrapperRight.appendChild(remove);
        fullWrapper.appendChild(wrapperLeft);
        fullWrapper.appendChild(wrapperRight);
        parent.appendChild(fullWrapper);
    }
    loadCart();

    function share(){
        alert("Share this link with others to show them your shopping cart: /shareCart?id=" + getId() );
    }



    function checkout() {
        if( totalAmount <= 0){
            alert("There are currently no items in your shopping cart");
            return;
        }
        if (getId() >= 10000) {
            alert("create an account to checkout");
            return;
        }
        location.href = '/shoppingcart/payment?amount=' + totalAmount + '&userId=' + getId();
    }
    </script>