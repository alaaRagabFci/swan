<template>
    <li class="dropdown dropdown-user dropdown-dark">
        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <span class="username username-hide-on-mobile"> Notifications <i class="fa fa-globe" aria-hidden="true"></i>
</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-default">
            <li v-for="notification in notifications">
                <a href="#" v-on:click="MarkAsRead(notification)">
                    SomeOne commented on your Post<br>
                    <!--<small>{{ notification.data.application.name }}</small>-->
                </a>
            </li>
            <li v-if="notifications.length == 0">
                There is no new notifications
            </li>
        </ul>
    </li>
</template>

<script>
    export default {
        props: ['notifications']
    }
</script>
