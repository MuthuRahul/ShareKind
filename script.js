var TrendingSlider = new Swiper('.trending-slider', {
    effect: 'coverflow',
    grabCursor: true,
    centeredSlides: true,
    loop: true,
    slidesPerView: 3, // Default for larger screens
    spaceBetween: 20,
    coverflowEffect: {
        rotate: 0,
        stretch: 0,
        depth: 100,
        modifier: 2.5,
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    lazy: {
        loadPrevNext: true,
    },
    breakpoints: {
        // Breakpoints for different screen sizes
        1440: { slidesPerView: 4 },  // 4 slides for large screens
        1024: { slidesPerView: 4 },  // 4 slides for medium screens
        768: { slidesPerView: 3 },   // 3 slides for tablets
        450: { slidesPerView: 3 },   // 3 slides for screens up to 450px
        320: { slidesPerView: 2 }    // 2 slides for very small screens (below 450px)
    }
});