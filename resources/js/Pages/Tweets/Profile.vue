<template>
    <app-layout>
        <template #header>
            <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              Profile de {{ profileUser.name }}
            </h2>


        <div v-if="profileUser.id !== $page.user.id">

                <inertia-link v-if="!profileUser.is_followed" as="button" :href="`/follows/${profileUser.id}`" method="POST" class="bg-white text-blue-500 cursor-pointer ml-6 px-5 py-2 hover:text-white border border-blue-500 leading-tight hover:bg-blue-500 rounded-full font-extrabold transition-all duration-300 " preserve-scroll>Suivre</inertia-link>

                <inertia-link  v-if="profileUser.is_followed"  :href="`/unfollows/${profileUser.id}`" method="POST" class="bg-blue-500 text-white cursor-pointer px-5 py-2 flex-shrink-0 hover:text-blue-500 border border-blue-500 leading-tight hover:bg-white rounded-full font-extrabold transition-all duration-300" preserve-scroll>Ne Plus Suivre</inertia-link>



        </div>
        </div>
        </template>


        <div class="py-10">
            <div class="max-w-4xl mx-auto sm:px-8 lg:px-10">
                <div v-for="tweet in tweets" v-bind:key="tweet.id" class="flex items-center space-x-4 bg-white overflow-hidden rounded rounded-b-none border-b-2 border-gray-200 py-6 px-4">
                    <img class="h-16 w-16 object-cover rounded-full" :src="profileUser.profile_photo_url">
                    <div class="flex flex-col w-2/3">
                        <div>
                            <a class="text-sm text-gray-900 font-bold hover:text-blue-400" :href="`/profile/${profileUser.name}`">
                                {{ profileUser.name }}
                            </a>
                            <span class="font-thin text-gray-400">· le {{ tweet.created_at }}</span>
                       <p class="text-sm text-blue-500" v-if="profileUser.is_following_you">
            Cet utilisateur vous suit
                       </p>
                        </div>
                        <div class="text-sm text-gray-400 font-thin">{{ tweet.content }}</div>
                    </div>
                    <div>

                    <!--    <a v-if="tweet.user.id === $page.user.id"  :href="`/delete/${tweet.id}`"  class="bg-white text-red-500 cursor-pointer px-5 py-2 hover:text-white border border-red-500 leading-tight hover:bg-red-500 rounded-full font-extrabold transition-all duration-300" preserve-scroll>Supprimer</a>
                   <button v-if="tweet.user.id === $page.user.id" @click="deleteRow(tweet)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-5  rounded">Delete</button>
                  -->
                    </div>


                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'



    export default {
        props: ['tweets' , 'profileUser'],

        components: {
            AppLayout,


        },

    }
</script>
