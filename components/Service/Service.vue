<template>
  <div class="service">
    <div class="anchor" :id="id" />
    <h2 class="service__title">{{title}}</h2>

    <div class="service__banner"  :class="{'service__banner-reversed' : reversed}">
      <img :src="`/img/services/${imagepath}`" :alt="title" class="service__image">
      <div class="service__banner-info">
        <p v-for="text in bannerText" :key="text" class="service__banner-text">{{text}}</p>
      </div>
    </div>

    <div v-if="additionalText.length" class="container service__additional-text-list">
      <p v-for="text in additionalText" :key="text" class="service__additional-text">
        {{text}}
      </p>
    </div>

    <div v-if="price.length || cases.length" class="service__collapse-list">
      <div v-if="price.length" class="service__collapse-item">
        <button
          @click="priceIsOpen = !priceIsOpen"
          class="service__collapse-toggle"
        >
          Цены
        </button>
        <Collapse
          :is-open="priceIsOpen"
        >
          <div v-if="price.length" class="service__price-wrapper">
            <table class="service__price" border="0">
              <tr v-for="item in price" :key="item.name">
                <td border="0">{{item.name}}</td>
                <td border="0">{{item.value}}</td>
              </tr>
            </table>
          </div>
        </Collapse>
      </div>
      <div v-if="cases.length" class="service__collapse-item">
        <button
          @click="sliderIsOpen = !sliderIsOpen"
          class="service__collapse-toggle"
        >
          Примеры работ
        </button>
        <Collapse
          :is-open="sliderIsOpen"
        >
          <div class="service__cases">
            <VueSlickCarousel v-if="cases.length" v-bind="settings" class="slick-works">
              <div v-for="(image, imageIndex) in cases" :key="imageIndex">
                <div class="slick-works__image-wrap" @click="sliderIndex = imageIndex">
                  <img :src="image.src" :alt="image.alt" class="slick-works__image">
                </div>
              </div>
            </VueSlickCarousel>
          </div>
        </Collapse>
      </div>
    </div>


    <CoolLightBox
      :items="cases"
      :index="sliderIndex"
      @close="sliderIndex = null"
    />
  </div>
</template>

<script>
import 'vue-slick-carousel/dist/vue-slick-carousel.css'
import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'
import '@/assets/styles/slick2.scss'
import VueSlickCarousel from 'vue-slick-carousel'
import CoolLightBox from 'vue-cool-lightbox'
import 'vue-cool-lightbox/dist/vue-cool-lightbox.min.css'
  export default {
    components: {
      VueSlickCarousel,
      CoolLightBox,
    },
    props: {
      id: {
        type: String,
        default: ''
      },
      title: {
        type: String,
        default: ''
      },
      imagepath: {
        type: String,
        default: ''
      },
      bannerText: {
        type: Array,
        default () {
          return []
        }
      },
      reversed: {
        type: Boolean,
        default: false
      },
      additionalText: {
        type: Array,
        default () {
          return []
        }
      },
      price: {
        type: Array,
        default () {
          return []
        }
      },
      cases: {
        type: Array,
        default () {
          return []
        }
      },
    },
    data () {
      return {
        sliderIndex: null,
        settings: {
          arrows: true,
          dots: true,
          slidesToShow: 3,
          infinite: true,
          swipe: false,
          autoplay: false,
          autoplaySpeed: 4000,
          responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 2,
                swipe: true
              }
            },
            {
              breakpoint: 767,
              settings: {
                autoplay: false,
                slidesToShow: 1,
                swipe: true
              }
            }
          ]
        },
        sliderIsOpen: false,
        priceIsOpen: false,
      }
    },
  }
</script>

<style lang="scss" scoped>
.service {
  padding: 0 10px;
  @media (max-width: 1023px) {
    padding: 0 20px;
  }
  @media (max-width: 767px) {
    padding: 0 10px;
  }

  &__collapse-list {
    display: flex;
    flex-direction: column;
    margin: 40px 0 0;
    border: 2px solid $COLOR_GREEN;
    border-radius: 6px;
  }

  &__collapse-item {
    border-bottom: 1px solid $COLOR_GREEN;

    &:last-of-type {
      border: none;
    }
  }

  &__collapse-toggle {
    width: 100%;
    padding: 8px;
    background: none;
    border-radius: 0px;
    border: none;
    text-align-last: left;
    font-size: 22px;
    cursor: pointer;
  }

  &__cases {
    padding: 20px 0 110px;
  }

  &__price-wrapper {
    display: flex;
    justify-content: center;
    margin: 20px 10px;

    @media (max-width: 500px) {
      overflow: scroll;
      justify-content: start;
    }
  }

  &__price {
    border-collapse: separate;
    border-spacing: 0;
    border: 1px solid #ffacac;
    border-radius: 6px;
    min-width: 500px;
    & td {
      padding: 8px;
    }

    & tr:nth-child(odd) {
      background-color: #8080802e;
    }

    @media (max-width: 767px) {
      font-size: 16px;
    }
  }

  &__banner {
    display: flex;
    margin: 40px 0;

    &-reversed {
      flex-direction: row-reverse;
    }

    @media (max-width: 1023px) {
      flex-direction: column;
      margin: 40px auto;
    }
  }

  &__image {
    display: block;
    width: 50%;
    max-height: 500px;

    @media (max-width: 1023px) {
      width: 100%;
    }
  }

  &__banner-info {
    display: flex;
    flex-direction: column;
    row-gap: 15px;
    width: 50%;
    padding: 24px;
    background-color: $COLOR_GREEN;
    color: $WHITE;

    @media (max-width: 1023px) {
      width: 100%;
    }

    @media (max-width: 767px) {
      padding: 12px;
    }
  }

  &__banner-text {
    font-size: 16px;
  }

  &__additional-text-list {
    display: flex;
    flex-direction: column;
    align-items: center;
    row-gap: 15px;
  }
  &__additional-text {
    text-align: center;
  }
}
</style>
