<template>
  <div>
    <header>
        <n-link :to="{name : 'index'}">
            <PushButton class="mr-2" size="l">
                Home Page
            </PushButton>
        </n-link>
    </header>

    <div class="w-1/6"></div>

    <div class="w-5/6 grid overflow-hidden grid-cols-2 grid-rows-3 gap-2">
        <div class="box row-span-2">
            <ResumeBasicInfo />
        </div>
        <div class="box">
            <ResumeSkills />
        </div>
        <div class="box">
            <ResumeHistory />
        </div>
    </div>

  </div>
</template>

<script>
export default {

  async fetch({store}){
    await store.dispatch('resume/getSkills')
    await store.dispatch('resume/getWorks')
  }

}
</script>

<style>

</style>