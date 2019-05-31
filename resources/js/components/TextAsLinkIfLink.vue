<template>

    <!--<span v-if="containsSlash(this.linkText)" v-html="titlePart(this.linkText)"></span>-->
    <!--<a v-else-if="isCodedLink(this.linkText)" :href="linkPart(this.linkText)" target="_blank"><span-->
            <!--class="glyphicon glyphicon-link"></span></a>-->
    <!--<a v-else-if="isLink(this.linkText)" :href="this.linkText" target="_blank">Link to Source</a>-->
    <span v-html="this.linkText" >
    </span>
</template>

<script>
    export default {
        props: ['linkText'],

        mounted() {
        },

        methods: {
            containsSlash(val) {
                // return false;
                return val.indexOf('/') > -1;
            },
            isLink(val) {
                return val.indexOf('http') > -1
            },
            isCodedLink(val) {
                return val.indexOf('::') > -1
            },
            titlePart(val) {
                var res = val.split("::");
                var res1 = res[0].split('/');
                var res2 = res1.join('<br>');
                // return res[0];
                return res2;
            },
            linkPart(val) {
                var res = val.split("::");

                return res[1];
            }
        },
    }
</script>
