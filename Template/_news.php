<section id="news">
    <div class="container pb-4">
        <h4 class="font-rubik font-size-20">Latest News</h4>
        <hr>

        <div class="owl-carousel owl-theme">
            <div class="item">
                <div class="card border-0 font-rale mr-5" style="width:18rem;">
                    <h5 class="card-title font-size-16">Upcoming Products</h5>
                    <img loading="lazy" width=216 src="assets/news/HCity.png" alt="cart image" class="card-img-top ">
                    <p class="card-text font-size-25 text-black py-1">Honda City</p>
                    <a href="#"class="color-second text-left">More. . .</a>
                </div>
            </div>
            <div class="item">
                <div class="card border-0 font-rale mr-5" style="width:18rem;">
                    <h5 class="card-title font-size-16">Upcoming Products</h5>
                    <img loading="lazy" width=216 src="assets/news/SErtiga.png" alt="cart image" class="card-img-top ">
                    <p class="card-text font-size-25 text-black py-1">Suzuki Ertiga</p>
                    <a href="#"class="color-second text-left">More. . .</a>
                </div>
            </div>
            <div class="item ">
                <div class="card border-0 font-rale mr-5" style="width:18rem;">
                    <h5 class="card-title font-size-16">Upcoming Products</h5>
                    <img loading="lazy" width=216 src="assets/news/SSwift.png" alt="cart image" class="card-img-top ">
                    <p class="card-text font-size-25 text-black py-1">Suzuki Swift</p>
                    <a href="#"class="color-second text-left">More. . .</a>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
const navOptions={
    threshold: .25,
};

const nav = document.querySelector('nav');
const cards = document.querySelectorAll("#backg");
const fade = document.querySelector(".fade-up");
const navbar = document.querySelector("#backyy");
const products=  document.querySelectorAll("#special-offers");

const observer = new IntersectionObserver(entries =>{
    console.log(entries[0].isIntersecting)
    nav.classList.toggle('active', !entries[0].isIntersecting)
    navbar.classList.toggle('active', !entries[0].isIntersecting)
    fade.classList.toggle('faded', !entries[0].isIntersecting)
}, navOptions);

observer.observe(cards[0]);
</script>