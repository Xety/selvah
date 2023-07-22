<template>
    <div class="flex flex-wrap">
        <div class="w-full">
            <ul class="flex mb-0 list-none flex-wrap pt-3 pb-4 flex-row">
                <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                    <a class="text-xs font-bold uppercase px-5 py-3 shadow-md rounded block leading-normal cursor-pointer" v-on:click="toggleTabs('incidents')" v-bind:class="{'text-neutral bg-white': openTab !== 'incidents', 'text-white bg-neutral': openTab === 'incidents'}">
                    Incidents
                    </a>
                </li>
                <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                    <a class="text-xs font-bold uppercase px-5 py-3 shadow-md rounded block leading-normal cursor-pointer" v-on:click="toggleTabs('maintenances')" v-bind:class="{'text-neutral bg-white': openTab !== 'maintenances', 'text-white bg-neutral': openTab === 'maintenances'}">
                    Maintenances
                    </a>
                </li>
            </ul>
            <div class="relative flex flex-col w-full mb-6">
            <div class="flex-auto">
                <div v-bind:class="{'hidden': openTab !== 'incidents', 'block': openTab === 'incidents'}">
                    <slot name="incidents"></slot>
                </div>
                <div v-bind:class="{'hidden': openTab !== 'maintenances', 'block': openTab === 'maintenances'}">
                    <slot name="maintenances"></slot>
                </div>
            </div>
            </div>
        </div>
    </div>
  </template>

  <script>
  export default {
    data() {
      return {
        openTab: 'incidents'
      }
    },
    mounted() {
        if (window.location.hash) {
            this.openTab = window.location.hash.substring(1);
        } else {
            window.location.hash = this.openTab;
        }
    },
    methods: {
      toggleTabs: function(tabNumber){
        this.openTab = tabNumber;
        window.location.hash = tabNumber;
      }
    }
  }
  </script>