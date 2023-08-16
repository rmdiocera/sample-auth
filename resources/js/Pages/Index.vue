<template>
<div class="container m-8">
    <span class="text-2xl block">Territories</span>
    <span class="text-lg">Here are the list of territories:</span>
    <ul class="list-disc pl-8 cursor-pointer" v-for="territory in territories_arr" :key="territory.id" @click="toggle">
        <li v-if="territory.cities.length > 0">
            {{ territory.name }}
            <ul class="list-disc pl-4 hidden" v-for="city in territory.cities" @click.prevent.stop="toggle">
                <li v-if="city.barangays.length > 0">
                    {{ city.name }}
                    <ul class="list-disc pl-4 hidden" v-for="barangay in city.barangays">
                        <li>{{ barangay.name }}</li>
                    </ul>
                </li>
                <li v-else>{{ city.name }}</li>
            </ul>
        </li>
        <li v-else>{{ territory.name }}</li>
    </ul>
</div>
</template>

<script setup>
const props = defineProps({
    territories: Array
})

const territories_arr = []

props.territories.forEach(el => {
    if (!el.parent) {
        var region = {}
        region.name = el.name
        region.id = el.id
        region.cities = []
        territories_arr.push(region)
    } else {
        if (el.parent.length == 1) {
            var municipality = []
            municipality.name = el.name
            municipality.id = el.id
            municipality.barangays = municipality.barangays ?? []
            territories_arr.find(territory => territory.id == el.parent).cities.push(municipality)
        } else {
            territories_arr.flatMap(territory => territory.cities).find(city => city.id == el.parent).barangays.push({"name": el.name, "id": el.id})
        }
    }
})

function toggle(e) {
    e.preventDefault()
    const elems = e.target.children
    for (let el of elems) {
        el.classList.toggle('hidden')
    }
}
</script>