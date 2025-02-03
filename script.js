document.querySelectorAll(".book-now").forEach(button => {
    button.addEventListener("click", function () {
        document.querySelector(".booking-form-overlay").style.display = "block";
        document.getElementById("car_name").value = this.dataset.car;
        document.getElementById("price_per_day").value = this.dataset.price;
    });
});

document.querySelector(".close-form").addEventListener("click", function () {
    document.querySelector(".booking-form-overlay").style.display = "none";
});

document.getElementById("end_date").addEventListener("change", function () {
    let startDate = new Date(document.getElementById("start_date").value);
    let endDate = new Date(this.value);
    let pricePerDay = parseFloat(document.getElementById("price_per_day").value);
    let days = (endDate - startDate) / (1000 * 60 * 60 * 24);
    
    let totalPrice = days * pricePerDay;
    if (days >= 7) {
        totalPrice *= 0.9;
    }
    
    document.getElementById("total_price").textContent = totalPrice.toFixed(2);
});
