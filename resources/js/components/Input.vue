<script setup lang="ts">
defineProps<{ id: string; label: string; modelValue: string; error: string | undefined; placeholder: string }>();
defineEmits<{ 'update:modelValue': (value: string) => void }>();
</script>

<template>
    <div class="flex flex-col">
        <label :for="id" class="mb-1 text-sm font-semibold text-gray-700">
            {{ label }}
        </label>

        <input
            :id="id"
            type="text"
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
            :placeholder="placeholder"
            class="rounded-lg border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            :class="{ 'border-red-500': error }"
        />

        <span v-if="error" class="mt-1 text-xs text-red-500">{{ error }}</span>
    </div>
</template>
