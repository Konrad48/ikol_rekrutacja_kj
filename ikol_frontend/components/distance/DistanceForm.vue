<template>
  <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-xl border-2 border-indigo-500">
    <h2 class="text-3xl font-bold mb-8 text-center text-indigo-900 tracking-tight">
      Distance Calculator
    </h2>
    <form @submit.prevent="handleSubmit" class="space-y-6">
      <div class="mb-6">
        <PointInput 
          title="Point A" 
          :point="pointA" 
          @validation="pointAValid = $event"
        />
      </div>
      <div class="mb-6">
        <PointInput 
          title="Point B" 
          :point="pointB"
          @validation="pointBValid = $event"
        />
      </div>
      <Button
        type="submit"
        :disabled="!isFormValid || isLoading"
        :class="[
          'w-full py-3 px-4 rounded-lg font-semibold transition-all duration-200 shadow-md',
          isFormValid && !isLoading
            ? 'bg-indigo-600 hover:bg-indigo-700 text-white shadow-indigo-200'
            : 'bg-gray-200 cursor-not-allowed text-gray-500'
        ]"
      >
        {{ submitButtonText }}
      </Button>
    </form>

    <DistanceResult v-if="distance" :distance="distance" />
  </div>
</template>

<script>
import PointInput from './PointInput.vue'
import DistanceResult from './DistanceResult.vue'
import Button from '../ui/Button.vue'

export default {
  name: 'DistanceForm',
  components: {
    PointInput,
    DistanceResult,
    Button,
  },
  data() {
    return {
      pointA: {
        latitude: 52.20750826666523,
        longitude: 20.914993759613797,
      },
      pointB: {
        latitude: 12.6464598156966,
        longitude: -8.0015034558936,
      },
      distance: null,
      pointAValid: false,
      pointBValid: false,
      isLoading: false,
    }
  },
  computed: {
    isFormValid() {
      return this.pointAValid && this.pointBValid
    },
    submitButtonText() {
      return this.isLoading ? 'Calculating distance...' : 'Calculate Distance'
    }
  },
  methods: {
    async handleSubmit() {
      this.isLoading = true
      const payload = {
        pointA: {
          latitude: parseFloat(this.pointA.latitude),
          longitude: parseFloat(this.pointA.longitude),
        },
        pointB: {
          latitude: parseFloat(this.pointB.latitude),
          longitude: parseFloat(this.pointB.longitude),
        },
      }
      try {
        const response = await $fetch('http://127.0.0.1:8000/api/calculate-distance', {
          method: 'POST',
          body: payload
        })
        if (response.status === 'success') {
          this.distance = response.data.distance
        } else {
          alert('Failed to calculate distance')
        }
      } catch (error) {
        console.error(error)
        alert('An error occurred while calculating distance')
      } finally {
        this.isLoading = false
      }
    },
  },
}
</script>