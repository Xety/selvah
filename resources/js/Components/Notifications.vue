<template>
    <div class="dropdown dropdown-end">
        <!-- Toggle notification menu -->
        <label tabindex="0" class="btn btn-ghost btn-circle">
            <div class="indicator">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
                <span class="badge badge-sm indicator-item badge-primary"></span>
            </div>
        </label>

        <div tabindex="0" class="mt-3 card card-compact dropdown-content w-96 bg-base-100 shadow">
            <div class="card-body">
                <h3 class="card-title  justify-center">
                    Notifications
                </h3>

                <div class="divider my-0"></div>

                <ul>
                    <li :key="notification.id" v-for="notification in notifications" class="hover:bg-slate-200 cursor-pointer flex dark:hover:bg-slate-700 rounded mb-3">
                                {{ console.log(notifications) }}
                        <div class="indicator w-full">
                            <a v-on:mouseover.prevent="markNotificationAsRead(notification)"
                                :href="getNotificationUrl(notification)" :class="'notification-' + notification.id" class="p-3 flex items-center">
                                <!-- Image -->
                                <i class="fa-solid fa-triangle-exclamation text-3xl text-primary mr-3" aria-hidden="true"></i>

                                <!-- Message -->
                                <span v-html="formatMessage(notification)" class="w-full"></span>

                                <!-- Badge new -->
                                <span v-if="notification.read_at === null" :class="'notification-' + notification.id + '-new'" class="badge badge-sm indicator-item badge-primary right-3">New</span>
                            </a>
                        </div>
                    </li>
                </ul>


            </div>
        </div>

    </div>
</template>

<script>
export default {
    //name:"notifications",
    /*props: [
        //notifications
    ],*/
    data() {
        return { notifications: {type: Object, default: null}}
    },
    mounted(){
        this.list()
    },
    methods:{
        async list() {
            await axios.get(`/api/notifications`).then(({data})=>{
                this.notifications = data
            }).catch(({ response })=>{
                console.error(response)
            })
        },

        /**
         * Format the message with vsprintf before rendering.
         *
         * @param {object} notification The current notification that is handled.
         *
         * @return {string} The parsed message.
         */
         formatMessage: function (notification) {
            console.log(notification);
            return vsprintf(notification.data.message, notification.data.message_key);
        },

        /**
         * Get the notification URL related to the notification `type`.
         *
         * @param {object} notification The current notification that is handled.
         *
         * @return {string} The notification URL.
         */
            getNotificationUrl: function (notification) {
                /*if (notification.data.type == 'alert') {
                    return notification.data.link;
                }*/

            //return this.routeUserNotifications;

            return '';
        }
    }
}
</script>