<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Mes abonnements
            </h2>
        </template>


        <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div v-for="follower in followings" v-bind:key="follower.id" class="flex items-center space-x-4 bg-white overflow-hidden rounded rounded-b-none border-b-2 border-gray-200 py-6 px-4">
                    <img class="h-16 w-16 object-cover rounded-full" :src="follower.user.profile_photo_url">
                    <div class="flex flex-col w-2/3">
                        <div>
                            <a class="text-sm text-gray-900 font-bold hover:text-blue-400" :href="`/profile/${follower.user.name}`">
                                {{ follower.user.name }}
                            </a>
                            <span class="font-thin text-gray-400">· le {{ follower.created_at }}</span>
                        </div>
                        <div class="text-sm text-gray-400 font-thin">{{ follower.content }}</div>
                    </div>

                        <inertia-link  as="button" :href="`/unfollows/${follower.user.id}`" method="POST" class="bg-blue-500 text-white cursor-pointer px-5 py-2 flex-shrink-0 hover:text-blue-500 border border-blue-500 leading-tight hover:bg-white rounded-full font-extrabold transition-all duration-300" preserve-scroll>Ne Plus Suivre</inertia-link>

                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'



    export default {
        props: ['followings'],

        components: {
            AppLayout,


        },
    }
</script>
