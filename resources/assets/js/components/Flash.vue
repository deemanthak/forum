<template>
    <div class="alert alert-warning alert-flash" role="alert" v-show="show">
        <strong>Success</strong> {{ body }}
    </div>
</template>

<script>
    export default {
        name: "Flash",
        props:['message'],
        data(){
            return {
                body:'',
                show:false
            }
        },
        created(){
            if(this.message){
               this.flash(this.message);
            }

            window.events.$on('flash',message=>{
               this.flash(message);
            });
        },
        methods:{
            flash(message){
                this.body = this.message;
                this.show=true;
                this.hide();
            },
            hide(){
                setTimeout(()=>{
                    this.show = false;
                },3000);
            }
        }
    }
</script>

<style scoped>
.alert-flash{
    position: fixed;
    right: 25px;
    bottom: 25px;
}
</style>