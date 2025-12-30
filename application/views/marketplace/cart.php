<!-- OFFCANVAS -->
<div class="offcanvas offcanvas-end border-0 shadow-lg" id="cartPanel" data-bs-backdrop="static" data-bs-scroll="false">
    <div class="offcanvas-header">
        <h5 class="fw-bold mb-0">Your Basket</h5>
        <button class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>

    <div class="offcanvas-body d-flex flex-column pt-0">

        <div id="cartItems" class="flex-grow-1 overflow-auto">

            <!-- Item -->
            <div class="cart-item p-3 border rounded-4 mb-3 d-flex gap-3 align-items-start" data-price="180000">

                <img src="https://nexory.id/uploads/products/img.jpg"
                     class="rounded-3"
                     style="width:90px;height:90px;object-fit:cover">

                <div class="flex-grow-1">
                    <div class="fw-semibold">Nexory FRAME Display</div>
                    <small class="text-muted d-block">Black | Standard Edition</small>
                    
                    <div class="text-dark fw-semibold mt-1">Rp 180.000</div>

                    <div class="d-flex align-items-center mt-2 gap-2">
                        <div class="input-group input-group-sm rounded-pill overflow-hidden" style="width:120px">
                            <button class="btn btn-dark qty-minus">−</button>
                            <input class="form-control text-center border-0 qty-input" value="1">
                            <button class="btn btn-dark qty-plus">+</button>
                        </div>

                        <button class="btn btn-light border rounded-circle p-1 btn-delete">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
            
             <!-- Item -->
            <div class="cart-item p-3 border rounded-4 mb-3 d-flex gap-3 align-items-start" data-price="35000">

                <img src="https://nexory.id/uploads/products/img.jpg"
                     class="rounded-3"
                     style="width:90px;height:90px;object-fit:cover">

                <div class="flex-grow-1">
                    <div class="fw-semibold">Nexory FRAME Display ONLY</div>
                    <small class="text-muted d-block">Black | Standard Edition</small>
                    
                    <div class="text-dark fw-semibold mt-1">Rp 35.000</div>

                    <div class="d-flex align-items-center mt-2 gap-2">
                        <div class="input-group input-group-sm rounded-pill overflow-hidden" style="width:120px">
                            <button class="btn btn-dark qty-minus">−</button>
                            <input class="form-control text-center border-0 qty-input" value="1">
                            <button class="btn btn-dark qty-plus">+</button>
                        </div>

                        <button class="btn btn-light border rounded-circle p-1 btn-delete">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            </div>

        </div>

        <!-- Footer Total -->
        <div class="mt-auto rounded-4 border p-3 bg-white">
            <div class="d-flex justify-content-between small text-muted">
                <span>Subtotal</span>
                <strong id="cartTotal" class="text-dark">Rp 180.000</strong>
            </div>

            <button class="btn btn-dark w-100 fw-semibold py-2 rounded-pill mt-3">
                Lanjutkan
            </button>

            <a href="#" class="d-block text-center mt-2 small text-decoration-underline" data-bs-dismiss="offcanvas">
                Batalkan
            </a>
        </div>
    </div>
</div>

<script>
document.addEventListener("click", function(e){

    // PLUS
    if(e.target.classList.contains("qty-plus")){
        let input = e.target.closest(".input-group").querySelector(".qty-input");
        input.value = parseInt(input.value) + 1;
        updateTotal();
    }

    // MINUS
    if(e.target.classList.contains("qty-minus")){
        let input = e.target.closest(".input-group").querySelector(".qty-input");
        let val = parseInt(input.value);
        if(val > 1) input.value = val - 1;
        updateTotal();
    }

    // DELETE
    if(e.target.closest(".btn-delete")){
        e.target.closest(".cart-item").remove();
        updateTotal();
    }

});

function updateTotal(){
    let total = 0;

    document.querySelectorAll(".cart-item").forEach(item=>{
        let price = parseInt(item.dataset.price);
        let qty = parseInt(item.querySelector(".qty-input").value);
        total += price * qty;
    });

    document.getElementById("cartTotal").innerText =
        "Rp " + total.toLocaleString("id-ID");
}

// initial total
updateTotal();
</script>
