<template>
    <div class="warpper" data-aos="fade-up" data-aos-duration="1500" data-aos-once="true">
        <h1 class="sectiontitle">How It Works</h1>
        <div class="contentwarpper" data-aos="fade-up" data-aos-duration="1500" data-aos-once="true">
            <div class="text-left mx-5">
                <div class="step"><h1>Step 1</h1></div> <hr>
                <div class="title mt-3"><h4>Organize your information</h4></div>
                <div class="paragraph"><p>Keep track of the projects you implement according to an appropriate category or subcategory.</p></div>
            </div>
            <div class="mx-5">
                <img :src="'../img/illustrator/request.png'" alt="">
            </div>
        </div>
        <div class="contentwarpper" data-aos="fade-up" data-aos-duration="1500" data-aos-once="true">
            <div class="mx-5">
                <img :src="'../img/illustrator/review.png'" alt="">
            </div>
            <div class="text-left mx-5">
                <div class="step"><h1>Step 2</h1></div> <hr>
                <div class="title mt-3"><h4>Review through the graphic system the distribution of projects.</h4></div>
                <div class="paragraph"><p>Check the list of items of each project collaboratively with authorized roles.</p></div>
            </div>
        </div>
        <div class="contentwarpper" data-aos="fade-up" data-aos-duration="1500" data-aos-once="true">
            <div class="text-left mx-5">
                <div class="step"><h1>Step 3</h1></div> <hr>
                <div class="title mt-3"><h4>Choose a package </h4></div>
                <div class="paragraph"><p>Select the package that best suits your needs, complete the payment and you will have access to this tool for the correct management of your projects.</p></div>
            </div>
            <div class="mx-5">
                <img :src="'../img/illustrator/accept.png'" alt="">
            </div>
        </div>
    </div>
</template>

<script>
export default {

}
</script>

<style scoped>
    .warpper{
        text-align: center;
    }
    .sectiontitle{
        font-weight: 600;
    }
    .contentwarpper{
        display: flex;
        justify-content: center;
        align-items: center;
        width: 60%;
        margin: 80px auto 0 auto;
    }
    .step h1{
        font-weight: 200;
    }
    .title h4{
        font-weight: 700;
        color: #134153;
    }
    .paragraph p{
        font-weight: 400;
        color: #999999;
        line-height: 1.8em;
    }
</style>
