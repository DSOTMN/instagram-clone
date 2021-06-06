<template>
    <div class="container">
        <a href="#" class="btn btn-primary ml-4" @click="followUser" v-text="buttonText"></a>
    </div>
</template>

<script>
    export default {
        props: ['userId', 'follows'],

        mounted() {
            console.log('Component mounted.')
        },

        data: function(){
            return {
                // postavljanje default state-a podataka- follows, to sam dodao i u props iznad
                status: this.follows,
            }
        },

        methods:{
            followUser(){
                axios.post('/follow/' + this.userId)
                .then(response => {

                    // when received successful response, change the status
                    this.status = !this.status;

                    console.log(response.data);
                }).catch(errors => {
                    if(errors.response.status == 401){
                        window.location = '/login';
                    }
                });
            }
        },

        computed:{
            buttonText(){
                // postavljanje texta putem petlje
                return (this.status) ? 'Unfollow' : 'Follow';
            }
        }

    }
</script>
