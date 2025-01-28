


gsap.registerPlugin(ScrollTrigger);

// Using Locomotive Scroll from Locomotive https://github.com/locomotivemtl/locomotive-scroll

const locoScroll = new LocomotiveScroll({
  el: document.querySelector("#main"),
  smooth: true
});
// each time Locomotive Scroll updates, tell ScrollTrigger to update too (sync positioning)
locoScroll.on("scroll", ScrollTrigger.update);

// tell ScrollTrigger to use these proxy methods for the "#main" element since Locomotive Scroll is hijacking things
ScrollTrigger.scrollerProxy("#main", {
  scrollTop(value) {
    return arguments.length ? locoScroll.scrollTo(value, 0, 0) : locoScroll.scroll.instance.scroll.y;
  }, // we don't have to define a scrollLeft because we're only scrolling vertically.
  getBoundingClientRect() {
    return {top: 0, left: 0, width: window.innerWidth, height: window.innerHeight};
  },
  // LocomotiveScroll handles things completely differently on mobile devices - it doesn't even transform the container at all! So to get the correct behavior and avoid jitters, we should pin things with position: fixed on mobile. We sense it by checking to see if there's a transform applied to the container (the LocomotiveScroll-controlled element).
  pinType: document.querySelector("#main").style.transform ? "transform" : "fixed"
});




// each time the window updates, we should refresh ScrollTrigger and then update LocomotiveScroll. 
ScrollTrigger.addEventListener("refresh", () => locoScroll.update());

// after everything is set up, refresh() ScrollTrigger and update LocomotiveScroll because padding may have been added for pinning, etc.
ScrollTrigger.refresh();









function page1Animation(){
    gsap.from("#page1 .overlay-text",{
        duration: 2,
        opacity:0,
        delay:1,
        ease: "power2.out",
        scrollTrigger: {
          trigger: "#page1 .overlay-text",
          scroller:"#main",
          toggleActions: "restart none restart none"
        }
      })
      gsap.to("#page1 .overlay-text", {
        duration: 6,
        opacity: 0,
        delay: 3, 
        ease: "power2.out",
     
    })


gsap.from("#page1 .video-container",{
    duration: 5,
    opacity:0,
    delay:0,
    ease: "power2.out",
    filter: "grayscale(100%) blur(5px)",
    scrollTrigger: {
      trigger: "#page1 .video-container",
      scroller:"#main",
      toggleActions: "restart none restart none"
    }

})


gsap.to("#page2 .welcomeTitle", {

  letterSpacing: "6px", // Increase letter-spacing during the scroll

  duration: 4, 
  ease: "power2.out",
  delay:0,
  scrollTrigger: {
    trigger: "#page2 .welcomeTitle",
    scroller:"#main",
    toggleActions: "restart none restart none",
    start: "top 80%", 
    end: "top 30%",
 
  }

});



}


page1Animation()

