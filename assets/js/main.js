// Calculate VH for AMAAAAAZNIG!
// function calcVH() {
//     var vH = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
//     document.getElementById("welcoming").setAttribute("style", "height:" + vH + "px;");
// }
// calcVH();
// window.addEventListener('onorientationchange', calcVH, true);


var $container = document.getElementById('isotope-list'); //The ID to attach isotope to
document.addEventListener("DOMContentLoaded", function() {


    // Declare isotope
    var iso = new Isotope($container,{
        itemSelector : '.article-container',
        layoutMode  : 'masonry',
        hiddenStyle:{
            opacity: 0
        },
        visibleStyle:{
            opacity: 1
        }
    });

    iso.arrange({filter: document.querySelector('.filters li:first-of-type a').dataset.filter});

    // Layout isotope after each image loads to prevent overlapping
    var imgLoad = imagesLoaded( $container );
    imgLoad.on('progress', function( instance, image){
        iso.layout();
        image.img.parentNode.classList.add('loaded');
    });

    //Add the class selected to the item that is clicked, and remove from the others
    var optionSets = document.getElementsByClassName('filters'),
        optionLinks = document.querySelectorAll('.filters li');

    for(var c=0; c<optionLinks.length; ++c){
        optionLinks[c].addEventListener('click', filter);
    }

    function filter(e){

        lazyLoad();
        window.scrollTo({
                top: document.getElementById('isotope-list').offsetTop - document.getElementsByClassName('filters')[1].offsetHeight,
                behavior: 'smooth'
            }
        );
        var $this = e.target;
        // don't proceed if already selected
        if ( $this.classList.contains('selected') ) {
            return false;
        }

        // Add selected class
        var selected = document.querySelectorAll('.filters .selected');
        for(var x = 0; x < selected.length; ++x){
            selected[x].classList.remove('selected');
        }
        var newSelected = document.querySelectorAll("li[data-name='" + $this.dataset.name + "']");
        for(var x = 0; x < newSelected.length; ++x){
            newSelected[x].classList.add('selected');
        }

        //When an item is clicked, sort the items.
        if (e.target.tagName === 'LI'){
            var selector = e.target.getElementsByTagName('a')[0].dataset.filter;
        } else {
            var selector = e.target.dataset.filter;
        }
        iso.arrange({filter: selector});

        return false;
    }

    var goTop = document.getElementsByClassName('go-top')[0];
    document.addEventListener('scroll',function(){
       var target = document.querySelector('.filter-row');
       if(target.getBoundingClientRect().top <= 0) {
           target.classList.add('active');
       } else {
           target.classList.remove('active');
       }

        if(window.scrollY > window.innerHeight){
            goTop.classList.add('active');
        } else {
            goTop.classList.remove('active');
        }
    });
    goTop.addEventListener('click',function(){
        window.scrollTo({
                top: document.getElementById('isotope-list').offsetTop - document.getElementsByClassName('filters')[1].offsetHeight,
                behavior: 'smooth'
            }
        );
    });


});


var lazyImages = [].slice.call(document.querySelectorAll("img.lazy"));
var active = false;

var lazyLoad = function() {
    if (active === false) {
        active = true;


        setTimeout(function() {
            lazyImages.forEach(function(lazyImage) {
                if ((lazyImage.getBoundingClientRect().top <= window.innerHeight && lazyImage.getBoundingClientRect().bottom >= 0) && getComputedStyle(lazyImage).display !== "none") {
                    lazyImage.src = lazyImage.dataset.src;
                    lazyImage.classList.remove("lazy");

                    lazyImages = lazyImages.filter(function(image) {
                        return image !== lazyImage;
                    });

                    if (lazyImages.length === 0) {
                        document.removeEventListener("scroll", lazyLoad);
                        window.removeEventListener("resize", lazyLoad);
                        window.removeEventListener("orientationchange", lazyLoad);
                    }
                }
            });

            active = false;
        }, 200);
    }
};

document.addEventListener("scroll", lazyLoad);
window.addEventListener("resize", lazyLoad);
window.addEventListener("orientationchange", lazyLoad);

document.addEventListener('click', function(e){
    if(e.target.classList.contains('article-image') && !e.target.classList.contains('linkable') && !e.target.classList.contains('gallery-trigger')){
        var $this = e.target,
            overlayContainer = document.getElementsByClassName('overlay')[0],
            clone = e.target.cloneNode(true),
            img = document.createElement('img'),
            img_container = document.createElement('div');

        img_container.classList.add('img-container');
        overlayContainer.classList.add('active');
        overlayContainer.appendChild(img_container);
        img_container.appendChild(clone);
        clone.classList.remove('article-image');
        img.setAttribute('src', $this.dataset.original);
        img.addEventListener('load',function(){
            clone.setAttribute('src', img.src);
            overlayContainer.classList.add('loaded');
            clone.classList.add('loaded');
        });
    }

    if(e.target.classList.contains('gallery-trigger')){
        var overlayContainer = document.getElementsByClassName('overlay')[0],
            galleryTrigger = e.target.dataset.galleryTrigger;

        overlayContainer.classList.add('active');
        overlayContainer.classList.add('loaded');

        var targetGallery = document.getElementById(galleryTrigger).cloneNode(true),
            cloneGallery = targetGallery.cloneNode(true);

        overlayContainer.appendChild(cloneGallery);

        var mySwiper = new Swiper (cloneGallery, {
            slidesPerView: 'auto',
            centeredSlides: true,
            spaceBetween: 50,
            pagination: {
                el: '.swiper-pagination',
                type: 'progressbar'
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev'
            }
        });
    }

    if(e.target.classList.contains('overlay') || e.target.classList.contains('close') || e.target.classList.contains('img-container')){
        document.getElementsByClassName('overlay')[0].classList.remove('active');
        document.getElementsByClassName('overlay')[0].classList.remove('loaded');
        setTimeout( function () {
            document.getElementsByClassName('overlay')[0].innerHTML = '<div class="close"></div>';
        }, 300);
    }

});

