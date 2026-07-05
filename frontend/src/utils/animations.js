export const fadeUp = {
  initial: {
    opacity: 0,
    transform: "translateY(30px)",
  },

  animate: {
    opacity: 1,
    transform: "translateY(0px)",
    transition: "all .6s ease",
  },
};

export const fade = {
  initial: {
    opacity: 0,
  },

  animate: {
    opacity: 1,
    transition: "opacity .5s ease",
  },
};