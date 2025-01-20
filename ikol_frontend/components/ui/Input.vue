<template>
  <div>
    <input
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
      :disabled="disabled"
      :class="[
        'focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none',
        error ? 'border-red-500' : 'border-gray-300',
        disabled ? 'bg-gray-100 cursor-not-allowed' : '',
        $attrs.class
      ]"
      v-bind="$attrs"
    />
    <p v-if="error" class="text-red-500 text-sm mt-1">{{ error }}</p>
  </div>
</template>


<script>
export default {
  name: 'Input',
  props: {
    modelValue: {
      type: [String, Number],
      default: ''
    },
    error: {
      type: String,
      default: ''
    },
    disabled: {
      type: Boolean,
      default: false
    }
  },
  inheritAttrs: false
}
</script>