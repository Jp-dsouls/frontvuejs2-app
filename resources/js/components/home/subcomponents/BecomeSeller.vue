<template>
  <div
    class="warpper d-flex flex-column justify-content-center"
    data-aos="fade-up"
    data-aos-duration="1500"
    data-aos-once="true"
  >
    <h1 class="sectiontitle">Order any of our packages</h1>
    <div class="contentwarpper">
      <div
        class="contentbox w-25 mx-5 my-5"
        data-aos="fade-up"
        data-aos-duration="1500"
        data-aos-once="true"
      >
        <div>
            <!-- <i class="icon fas fa-users"></i> -->
            <div class="rounded-circle with-circle-content" style="background: #42798f">
                <p class="rounded-circle m-0 with-circle" >S/.
                    <strong class="h3">100</strong>
                </p>
            </div>
        </div>
        <div class="title mt-4"><h4>Basic</h4></div>
        <div class="paragraph mt-2">
            <ul class="text-left list-price">
                <li>Including product & sales management</li>
                <li>Including product & sales management</li>
                <li>Including product & sales management</li>
                <li>Including product & sales management</li>
            </ul>
        </div>
      </div>
      <div
        class="contentbox w-25 mx-5 my-5"
        data-aos="fade-up"
        data-aos-duration="1500"
        data-aos-once="true"
      >
        <div>
            <!-- <i class="icon fas fa-users"></i> -->
            <div class="rounded-circle with-circle-content" style="background: #42798f">
                <p class="rounded-circle m-0 with-circle" >S/.
                    <strong class="h3">100</strong>
                </p>
            </div>
        </div>
        <div class="title mt-4"><h4>Premium</h4></div>
        <div class="paragraph mt-2">
          <ul class="text-left list-price">
                <li>Including product & sales management</li>
                <li>Including product & sales management</li>
                <li>Including product & sales management</li>
                <li>Including product & sales management</li>
            </ul>
        </div>
      </div>
      <div
        class="contentbox w-25 mx-5 my-5"
        data-aos="fade-up"
        data-aos-duration="1500"
        data-aos-once="true"
      >
        <div>
            <!-- <i class="icon fas fa-users"></i> -->
            <div class="rounded-circle with-circle-content" style="background: #42798f">
                <p class="rounded-circle m-0 with-circle" >S/.
                    <strong class="h3">100</strong>
                </p>
            </div>
        </div>
        <div class="title mt-4"><h4>single</h4></div>
        <div class="paragraph mt-2">
          <ul class="text-left list-price">
                <li>Including product & sales management</li>
                <li>Including product & sales management</li>
                <li>Including product & sales management</li>
                <li>Including product & sales management</li>
            </ul>
        </div>
      </div>
    </div>
    <a href="/register"
      ><div class="joinbutton mx-auto text-1">Join Now</div></a
    >
  </div>
</template>

<script>
export default {};
</script>

<style scoped>
.warpper {
  text-align: center;
  background-color: #134153;
  color: #fcfaf1;
  height: calc(100vh - 50px);
}
.sectiontitle {
  font-weight: 600;
}

.contentwarpper {
  display: flex;
  justify-content: center;
  /* align-items: center; */
}

.contentbox {
  border-radius: 50px;
  background: #134153;
  box-shadow: 20px 20px 60px #103747, -20px -20px 60px #164b5f;
  padding: 50px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}
.icon {
  font-size: 50px;
}
.title h4 {
  font-weight: 700;
  line-height: 1.5em;
}
.paragraph p {
  font-weight: 400;
  color: #fcfaf1;
  line-height: 1.8em;
}

.joinbutton {
  cursor: pointer;
  line-height: 45px;
  margin-top: 15px;
  max-width: 160px;
  width: 100%;
  background-color: rgba(144, 46, 46, 1);

  box-shadow: inset 0 0 20px rgba(46, 130, 139, 0);
  outline-color: rgba(190, 218, 250, 0.5);
  outline-offset: 0px;
  text-shadow: none;
  transition: all 1250ms cubic-bezier(0.19, 1, 0.22, 1);
}
.joinbutton:hover {
  box-shadow: inset 0 0 20px rgba(46, 130, 139, 0.5),
    0 0 20px rgba(46, 130, 139, 0.2);
  outline: 1px solid;
  outline-color: rgba(190, 218, 250, 0);
  outline-offset: 15px;
  text-shadow: 1px 1px 2px #2e828b;
}
.list-price{
    list-style-image: url("./../../../../../public/img/icon/check.png");
}
.with-circle-content{
    width: 7rem;
    height: 7rem;
    display: flex;
    justify-content: center;
    align-items: center;
}
.with-circle{
    border: solid 3px white;
    width: 6rem;
    height: 6rem;
    text-align: center;
    justify-content: center;
    align-items: center;
    display: flex;
}
</style>
