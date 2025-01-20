<template>
  <div class="bg-indigo-50 p-4 rounded-lg">
    <h3 class="text-lg font-semibold mb-4 text-indigo-900">{{ title }}</h3>
    <div class="mb-4">
      <label class="block mb-2 text-sm font-medium text-indigo-800">Latitude</label>
      <Input
        class="w-full p-2.5 border-2 border-indigo-200 rounded-lg focus:border-indigo-500
               bg-white shadow-sm transition-all duration-200"
        type="number"
        step="any"
        v-model="point.latitude"
        required
      />
    </div>
    <div>
      <label class="block mb-2 text-sm font-medium text-indigo-800">Longitude</label>
      <Input
        class="w-full p-2.5 border-2 border-indigo-200 rounded-lg focus:border-indigo-500
               bg-white shadow-sm transition-all duration-200"
        type="number"
        step="any"
        v-model="point.longitude"
        required
      />
    </div>
  </div>
</template>

<script>
import Input from '../ui/Input.vue'

export default {
  name: 'PointInput',
  components: {
    Input,
  },
  props: {
    title: String,
    point: Object,
    disabled: {
      type: Boolean,
      default: false
    }
  },
  computed: {
    latitudeError() {
      const lat = parseFloat(this.point.latitude)
      if (isNaN(lat)) return 'Latitude must be a number'
      if (lat < -90 || lat > 90) return 'Latitude must be between -90 and 90'
      return ''
    },
    longitudeError() {
      const lng = parseFloat(this.point.longitude)
      if (isNaN(lng)) return 'Longitude must be a number'
      if (lng < -180 || lng > 180) return 'Longitude must be between -180 and 180'
      return ''
    },
    isValid() {
      return !this.latitudeError && !this.longitudeError
    }
  },
  watch: {
    isValid: {
      immediate: true,
      handler(newValue) {
        this.$emit('validation', newValue)
      }
    }
  }
}
</script>