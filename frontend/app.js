import { animate, inView } from "https://cdn.jsdelivr.net/npm/motion@12.23.24/+esm";

inView(".animate-scroll", (element) => {
  animate(
    element,
    { 
      opacity: 1, 
      y: [80, 0] 
    },
    { 
      duration: 1,
      delay: element.dataset.delay ? parseFloat(element.dataset.delay) : 0,
      easing: [0.17, 0.55, 0.55, 1]
    }
  );

  return () =>
    animate(element, { opacity: 1, });
});
