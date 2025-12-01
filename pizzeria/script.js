let cart = [];
let delivery = null;

function updateCart() {
    const cartItemsDiv = document.getElementById("cart-items");
    const cartTotal = document.getElementById("cart-total");
    cartItemsDiv.innerHTML = "";
    
    if(cart.length === 0){
        cartItemsDiv.innerHTML = "<p>Panier vide</p>";
        cartTotal.textContent = "Total : 0€";
        return;
    }

    let total = 0;
    cart.forEach((p,i)=>{
        total += p.price*p.qty;
        const item = document.createElement("div");
        item.className="cart-item";
        item.innerHTML = `
            <span>${p.name} - ${p.price}€</span>
            <div>
                <button onclick="changeQty(${i},-1)">-</button>
                <span>${p.qty}</span>
                <button onclick="changeQty(${i},1)">+</button>
                <button onclick="removeItem(${i})">X</button>
            </div>`;
        cartItemsDiv.appendChild(item);
    });
    cartTotal.textContent = `Total : ${total}€`;
}

function changeQty(i, amt){
    cart[i].qty += amt;
    if(cart[i].qty <= 0) cart.splice(i,1);
    updateCart();
}

function removeItem(i){
    cart.splice(i,1);
    updateCart();
}

document.querySelectorAll(".addCart").forEach(btn=>{
    btn.onclick=()=>{
        const name=btn.dataset.name;
        const price=parseFloat(btn.dataset.price);
        const exist=cart.find(p=>p.name===name);
        if(exist) exist.qty++;
        else cart.push({name,price,qty:1});
        updateCart();
    };
});

document.getElementById("saveDelivery").onclick=()=>{
    const addr=document.getElementById("address").value;
    const city=document.getElementById("city").value;
    const postal=document.getElementById("postal").value;
    if(!addr||!city||!postal){ alert("Complétez l'adresse."); return; }
    delivery={address:addr,city,postal};
    alert("Adresse enregistrée !");
};

document.getElementById("orderBtn").onclick=()=>{
    if(cart.length===0) return alert("Panier vide !");
    if(!delivery) return alert("Adresse manquante !");
    fetch("order.php",{
        method:"POST",
        headers:{"Content-Type":"application/json"},
        body:JSON.stringify({cart,delivery})
    }).then(r=>r.json()).then(d=>{
        alert(d.message);
        cart=[];
        updateCart();
    });
};

updateCart();
