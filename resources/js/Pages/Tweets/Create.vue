<template>
        <div class="py-6">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <form @submit.prevent="tweetStore">
                  <textarea v-model="content" placeholder="Que se passe-t-ill?" class="bg-blue-200 rounded-lg border
                border-gray-200 text-blue-500 w-full p-2 font-semibold resize-none focus:outline-none">
                    </textarea>
                    <span class="my-5 text-red-500" v-if= "$page.errors.content">
                              {{$page.errors.content}}


                    </span>
                      <div class="flex items-center space-x-4 justify-end mt-3">
                          <p v-if="280 - content.length <= 0" class="text-sm font-thin text-red-500" > 0 caractére restant </p>
                          <p v-if="280 -content.length > 0" :class="280 - content.length  < 10 ?'text-yellow-500':'text-green-500'" class="text-sm font-thin"> {{280 - content.length}} caractére<span v-if="280-content.length !=1">s</span> restant<span v-if="280-content.length !=1">s</span></p>
                      <button-vue :disabled="!canSubmit" class="bg-blue-500 hover:bg-blue-800 rounded-full font-extrabold">Tweet</button-vue>
                          <button-vue type="reset" class="bg-orange-400  hover:bg-red-500 rounded-full font-extrabold">Clear</button-vue>
                      </div>

                </form>
            </div>
        </div>

</template>

<script>
        import ButtonVue from "@/Jetstream/Button";


    export default {
        props: [],

        components: {
            ButtonVue,

        },
        methods :{
            tweetStore() {
                this.$inertia.post('tweets', {content: this.content}, {preserveEvent:false});
                 this.content ="";
            }
        },
        data() {
            return {
                content : ""
            }
        },
        computed: {
            canSubmit() {
                return this.content.length && (280 - this.content.length) >= 0
            }
        }
    }
</script>

<style scoped>
    button:disabled {
        opacity: 50%;
        cursor: not-allowed;
    }
</style>
