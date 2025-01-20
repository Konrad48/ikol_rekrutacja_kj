<template>
  <div class="mt-8 bg-indigo-50 p-6 rounded-lg border border-indigo-200">
    <h2 class="text-2xl font-bold mb-4 text-indigo-900">Result</h2>
    <div class="space-y-2">
      <p class="text-indigo-800 flex justify-between items-center">
        <span class="font-medium">Distance in Meters:</span>
        <span class="text-lg">{{ distance.meters }}</span>
      </p>
      <p class="text-indigo-800 flex justify-between items-center">
        <span class="font-medium">Distance in Kilometers:</span>
        <span class="text-lg">{{ distance.kilometers }}</span>
      </p>
    </div>
  </div>
</template>

<script>
export default {
  name: 'DistanceResult',
  props: {
    distance: Object,
  },
}
</script>