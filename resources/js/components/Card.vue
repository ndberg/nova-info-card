<template>
  <Card>
    <div class="info-card card" :style="[containerClasses]">
      <div class="info-card-icon-container">
        <svg :id="`${card.theme}-icon`" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" :style="[iconClasses]">
          <path :d="getPathFromTheme"/>
        </svg>
      </div>
      <div class="info-card-text-container">
        <h2 v-if="card.withHeading" :style="[messageClasses]">{{ card.heading }}</h2>
        <p :style="messageClasses" v-if="card.asHtml" v-html="card.message"/>
        <p :style="messageClasses" v-else v-text="card.message"/>
      </div>
  </div>
  </Card>
</template>

<script>

export default {
  props: [
    'card'

    // The following props are only available on resource detail cards...
    // 'resource',
    // 'resourceId',
    // 'resourceName',
  ],

  data: () => ({
    themes: {
      info: {
        color: "blue"
      },
      success: {
        color: "green"
      },
      warning: {
        color: "yellow"
      },
      danger: {
        color: "red"
      }
    },
    colors: {
      'blue-200': 'rgb(191 219 254)',
      'green-200': 'rgb(187 247 208)',
      'yellow-200': 'rgb(254 240 138)',
      'red-200': 'rgb(254 202 202)',
      'blue-600': 'rgb(37 99 235)',
      'green-600': 'rgb(22 163 74)',
      'yellow-600': 'rgb(202 138 4)',
      'red-600': 'rgb(220 38 38)',
    }
  }),

  computed: {
    theme() {
      return this.themes[this.card.theme]
    },

    color() {
      return this.theme.color
    },

    containerClasses() {
      const backgroundColor = this.getColor('background', `${this.color}-200`)
      const color = this.getColor('border', `${this.color}-600`)

      return {...backgroundColor, ...color}
    },

    messageClasses() {
      return this.getColor('text', `${this.color}-600`)
    },

    iconClasses() {
      return this.getColor('icon', `${this.color}-600`)
    },

    getPathFromTheme() {
      switch (this.card.theme) {
        case 'danger':
          return "M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 10.5858L9.17157 7.75736L7.75736 9.17157L10.5858 12L7.75736 14.8284L9.17157 16.2426L12 13.4142L14.8284 16.2426L16.2426 14.8284L13.4142 12L16.2426 9.17157L14.8284 7.75736L12 10.5858Z"
        case 'warning':
          return "M12.865 3.00017L22.3912 19.5002C22.6674 19.9785 22.5035 20.5901 22.0252 20.8662C21.8732 20.954 21.7008 21.0002 21.5252 21.0002H2.47266C1.92037 21.0002 1.47266 20.5525 1.47266 20.0002C1.47266 19.8246 1.51886 19.6522 1.60663 19.5002L11.1329 3.00017C11.4091 2.52187 12.0206 2.358 12.4989 2.63414C12.651 2.72191 12.7772 2.84815 12.865 3.00017ZM10.9989 16.0002V18.0002H12.9989V16.0002H10.9989ZM10.9989 9.00017V14.0002H12.9989V9.00017H10.9989Z"
        case 'success':
          return "M10.0007 15.1709L19.1931 5.97852L20.6073 7.39273L10.0007 17.9993L3.63672 11.6354L5.05093 10.2212L10.0007 15.1709Z"
        default:
          return "M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM11 11V17H13V11H11ZM11 7V9H13V7H11Z"
      }
    }
  },

  methods: {
    getColorStyle(color, part = '') {
      switch (part) {
        case 'background':
          part = 'backgroundColor'
          break;
        case 'text':
          part = 'color'
          break;
        case 'border':
          part = 'borderColor'
          break;
        case 'icon':
          part = 'fill'
      }

      return {
        [part]: this.colors[color] ?? color
      }
    },

    getCustomColor(part, fallbackColor) {
      return this.card.colors[part] ?? this.card.colors[fallbackColor] ?? fallbackColor
    },

    getColor(part, fallback) {
      return this.getColorStyle(this.getCustomColor(part, fallback), part)
    }
  }
}
</script>

<style>
.info-card {
  align-items: center;
  border-top-width: 4px;
  border-radius: .5rem;
  display: flex;
  padding: .75rem;
}

.info-card .info-card-icon-container {
  width: 1.5rem;
  height: 1.5rem;
  margin-right: 1rem;
  align-self: flex-start;
}

.info-card .info-card-text-container {
  font-size: 1rem;
  font-weight: 700;
  line-height: 1;
}
</style>
