class Carousel {
  constructor (element) {
    // Main elements
    this.carousel = element
    this.track = element.querySelector('.carousel-track')
    this.slides = [...element.querySelectorAll('.carousel-slide')]

    // Navigation elements
    this.prevButton = element.querySelector('.carousel-button.prev')
    this.nextButton = element.querySelector('.carousel-button.next')
    this.dotsContainer = element.querySelector('.carousel-dots')

    // State
    this.currentSlide = 0
    this.slideCount = this.slides.length
    this.isDragging = false
    this.startPos = 0
    this.currentTranslate = 0
    this.prevTranslate = 0
    this.animationID = 0
    this.autoplayInterval = null

    // Constants
    this.TRANSITION_DURATION = 500 // ms
    this.AUTOPLAY_DELAY = 5000 // ms
    this.DRAG_THRESHOLD = 0.2 // 20% of slide width
    this.EDGE_RESISTANCE = 0.3 // Resistance at edges

    this.initialize()
  }

  initialize () {
    // Set initial styles
    this.track.style.transition = `transform ${this.TRANSITION_DURATION}ms ease-in-out`

    // Create navigation dots
    this.createDots()

    // Add event listeners
    this.addEventListeners()

    // Set initial position
    this.updateCarousel()

    // Start autoplay
    this.startAutoplay()
  }

  createDots () {
    this.dotsContainer.innerHTML = '' // Clear existing dots
    for (let i = 0; i < this.slideCount; i++) {
      const dot = document.createElement('div')
      dot.classList.add('dot')
      if (i === 0) dot.classList.add('active')
      dot.addEventListener('click', () => {
        this.stopAutoplay()
        this.goToSlide(i)
        this.startAutoplay()
      })
      this.dotsContainer.appendChild(dot)
    }
  }

  addEventListeners () {
    // Button navigation
    this.prevButton.addEventListener('click', () => {
      this.stopAutoplay()
      this.prev()
      this.startAutoplay()
    })

    this.nextButton.addEventListener('click', () => {
      this.stopAutoplay()
      this.next()
      this.startAutoplay()
    })

    // Touch events
    this.track.addEventListener('touchstart', this.touchStart.bind(this), {
      passive: true
    })
    this.track.addEventListener('touchmove', this.touchMove.bind(this), {
      passive: false
    })
    this.track.addEventListener('touchend', this.touchEnd.bind(this))

    // Mouse events
    this.track.addEventListener('mousedown', this.touchStart.bind(this))
    this.track.addEventListener('mousemove', this.touchMove.bind(this))
    this.track.addEventListener('mouseup', this.touchEnd.bind(this))
    this.track.addEventListener('mouseleave', this.touchEnd.bind(this))

    // Prevent context menu on long press
    this.track.addEventListener('contextmenu', e => e.preventDefault())

    // Pause autoplay when tab is not visible
    document.addEventListener('visibilitychange', () => {
      if (document.hidden) {
        this.stopAutoplay()
      } else {
        this.startAutoplay()
      }
    })

    // Resize handling
    let resizeTimer
    window.addEventListener('resize', () => {
      clearTimeout(resizeTimer)
      resizeTimer = setTimeout(() => {
        this.updateCarousel()
      }, 250)
    })
  }

  touchStart (event) {
    if (event.type.includes('mouse')) {
      event.preventDefault()
    }

    this.isDragging = true
    this.startPos = this.getPositionX(event)
    this.track.style.transition = 'none'
    this.track.classList.add('dragging')
    this.stopAutoplay()

    // Cancel any ongoing animation
    if (this.animationID) {
      cancelAnimationFrame(this.animationID)
    }
  }

  touchMove (event) {
    if (!this.isDragging) return

    event.preventDefault()
    const currentPosition = this.getPositionX(event)
    const diff = currentPosition - this.startPos
    this.currentTranslate = this.prevTranslate + diff

    // Add resistance at edges
    if (
      this.currentTranslate > 0 ||
      this.currentTranslate < -(this.slideCount - 1) * this.carousel.offsetWidth
    ) {
      this.currentTranslate = this.prevTranslate + diff * this.EDGE_RESISTANCE
    }

    this.updateTransform()
  }

  touchEnd () {
    if (!this.isDragging) return

    this.isDragging = false
    this.track.classList.remove('dragging')
    this.track.style.transition = `transform ${this.TRANSITION_DURATION}ms ease-in-out`

    const movedBy = this.currentTranslate - this.prevTranslate
    const threshold = this.carousel.offsetWidth * this.DRAG_THRESHOLD

    if (Math.abs(movedBy) > threshold) {
      if (movedBy < 0) {
        this.next()
      } else {
        this.prev()
      }
    } else {
      this.goToSlide(this.currentSlide)
    }

    this.startAutoplay()
  }

  getPositionX (event) {
    return event.type.includes('mouse') ? event.pageX : event.touches[0].clientX
  }

  prev () {
    this.currentSlide =
      (this.currentSlide - 1 + this.slideCount) % this.slideCount
    this.updateCarousel()
  }

  next () {
    this.currentSlide = (this.currentSlide + 1) % this.slideCount
    this.updateCarousel()
  }

  goToSlide (index) {
    if (index === this.currentSlide) return
    this.currentSlide = Math.max(0, Math.min(index, this.slideCount - 1))
    this.updateCarousel()
  }

  updateCarousel () {
    // Update transform
    this.currentTranslate = -this.currentSlide * this.carousel.offsetWidth
    this.prevTranslate = this.currentTranslate
    this.updateTransform()

    // Update dots
    const dots = [...this.dotsContainer.children]
    dots.forEach((dot, index) => {
      dot.classList.toggle('active', index === this.currentSlide)
    })

    // Update ARIA attributes for accessibility
    this.slides.forEach((slide, index) => {
      slide.setAttribute('aria-hidden', index !== this.currentSlide)
      slide.setAttribute('tabindex', index === this.currentSlide ? '0' : '-1')
    })
  }

  updateTransform () {
    this.track.style.transform = `translateX(${this.currentTranslate}px)`
  }

  startAutoplay () {
    this.stopAutoplay()

    if (this.slideCount > 1) {
      this.autoplayInterval = setInterval(() => {
        this.track.style.transition = `transform ${this.TRANSITION_DURATION}ms ease-in-out`
        this.next()
      }, this.AUTOPLAY_DELAY)
    }
  }

  stopAutoplay () {
    if (this.autoplayInterval) {
      clearInterval(this.autoplayInterval)
      this.autoplayInterval = null
    }
  }
}

// Initialize all carousels when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
  const carousels = document.querySelectorAll('.custom-carousel')
  carousels.forEach(carousel => new Carousel(carousel))
})
