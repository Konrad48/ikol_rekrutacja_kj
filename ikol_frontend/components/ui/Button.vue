<template>
  <button
    :type="type"
    :disabled="disabled"
    :class="[
      'focus:outline-none focus:ring-2 focus:ring-offset-2 transition-colors',
      disabled ? 'cursor-not-allowed' : '',
      $attrs.class
    ]"
    v-bind="$attrs"
  >
    <slot></slot>
  </button>
</template>

<script>
export default {
  name: 'Button',
  props: {
    type: {
      type: String,
      default: 'button',
      validator: (value) => ['button', 'submit', 'reset'].includes(value)
    },
    disabled: {
      type: Boolean,
      default: false
    }
  },
  inheritAttrs: false
}
</script>