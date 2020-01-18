<template>
  <div class="p-form-inputs-wrapper">
    <div class="p-form-inputs --register">

        <dl>
          <dt>STEPのタイトル</dt>
          <dd>{{ form.title }}</dd>
        </dl>

        <dl>
          <dt>カテゴリー</dt>
          <dd>{{ form.category_id }}</dd>
        </dl>

        <dl>
          <dt>STEPの紹介文</dt>
          <dd>{{ form.info }}</dd>
        </dl>

        <dl>
          <dt>達成目安時間</dt>
          <dd>{{ form.time }}</dd>
        </dl>

        <div v-for="kostep in form.kosteps"
          :key="kostep.id">
          <dl>
            <dt>子STEP</dt>
            <dd>{{ form.id }}</dd>
          </dl>
          <dl>
            <dt>タイトル</dt>
            <dd>{{ form.title }}</dd>
          </dl>
          <dl>
            <dt>説明</dt>
            <dd>{{ form.info }}</dd>
          </dl>
        </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'StepForm03',
  props:{
    form: Object
  }
}
</script>