<template>
  <form>
    <div class="p-form-inputs-wrapper">
      <div class="p-form-inputs as_register">

        <dl>
          <dt><label for="title">STEPのタイトル<span>必須</span></label></dt>
          <dd>
            <input 
              type="text" 
              id="title" 
              v-model="title" 
              placeholder="STEPのタイトルを入力してください"
              @blur="$v.title.$touch()">
              <div v-if="$v.title.$error">
                <span v-if="!$v.title.required" class="p-form__errorMsg" role="alert">
                  <strong>タイトルが入力されていません</strong>
                </span>
                <span v-if="!$v.title.maxLength" class="p-form__errorMsg" role="alert">
                  <strong>50文字以内で入力をしてください</strong>
                </span>
              </diV>
          </dd>
        </dl>

        <dl>
          <dt><label for="category-form">カテゴリー<span>必須</span></label></dt>
          <dd class="p-form-input__select">
            <select id="category-form" v-model="category_id">
              <option v-for="category in categories"
                :key="category.id" 
                :value="category.id">
                {{ category.name }}
              </option>
            </select>
            <div v-if="$v.category_id.$error">
              <span v-if="!$v.category_id.required" class="p-form__errorMsg" role="alert">
                <strong>選択されていません</strong>
              </span>
            </diV>
          </dd>
        </dl>

        <dl>
          <dt><label for="info">STEPの紹介文<span>必須</span></label></dt>
          <dd>
            <textarea 
              id="info" 
              v-model="info" 
              cols="30" rows="10"
              placeholder="200文字以内で入力をしてください"
              @blur="$v.info.$touch()"></textarea>
              <div v-if="$v.info.$error">
                <span v-if="!$v.info.required" class="p-form__errorMsg" role="alert">
                  <strong>紹介文が入力されていません</strong>
                </span>
                <span v-if="!$v.info.maxLength" class="p-form__errorMsg" role="alert">
                  <strong>200文字以内で入力をしてください</strong>
                </span>
              </diV>
          </dd>
        </dl>

        <dl>
          <dt><label for="time">達成目安時間<span>必須</span></label></dt>
          <dd>
            <input 
              id="time" 
              class="p-form-input__time" 
              v-model="time" 
              type="number" 
              placeholder="選択してください"
              min="0"
              @blur="$v.time.$touch()">時間
              <div v-if="$v.time.$error">
                <span v-if="!$v.time.required" class="p-form__errorMsg" role="alert">
                  <strong>入力されていません</strong>
                </span>
                <span v-if="!$v.time.between" class="p-form__errorMsg" role="alert">
                  <strong>1〜999時間以内で入力をしてください。</strong>
                </span>
              </diV>
          </dd>
        </dl>
        <dl class="p-form-file">
          <dt>
            <figure class="p-form-file__photo" v-if="value.photo">
              <img class="js-objectfit" :src="'../../img/update/step/' + value.photo + '.jpg'">
            </figure>

            <label v-show="!uploadedImage" class="p-form-file__label">
              アイキャッチ画像を選択
              <input type="file" name="file" @change="onFileChange"/>
            </label>
          </dt>

          <dd>
            <div class="p-form-file-preview" v-show="uploadedImage">
              <img
                v-show="uploadedImage"
                class="p-form-file-preview__file js-objectfit"
                :src="uploadedImage"
              />
            </div>
            <div v-show="uploadedImage" class="p-form-file__btn" @click="remove">
              <span>削除する<i class="fas fa-times"></i></span>
            </div>
          </dd>
        </dl>
      </div>

      <div class="p-form-submit">
        <button
        class="c-btn" 
        type="button" 
        @click="nextStep" 
        :disabled="$v.$invalid">次へ</button>
      </div>
    </div>
  </form>
</template>

<script>
import { required, maxLength, between } from 'vuelidate/lib/validators'

export default {
  name: 'FormStep',
  props:{
    value: { type: Object, required: true},
    categories: { type: Array, required: true},
  },
  data: function () {
    return{
      stepNumber: 1,
      uploadedImage: ''
    }
  },
  // バリデーション
  validations:{
    title: {
      required,
      maxLength: maxLength(50)
    },
    category_id: {
      required
    },
    info: {
      required,
      maxLength: maxLength(200)
    },
    time: {
      required,
      between: between(0, 999)
    }  
  },
  // 入力値をバインディングする
  computed:{
    title: {
      get: function() {
        return this.value.title
      },
      set: function(title) {
        this.updateValue({ title })
      }
    },
    category_id: {
      get: function() {
        return this.value.category_id
      },
      set: function(category_id) {
        this.updateValue({ category_id })
      }
    },
    info: {
      get: function() {
        return this.value.info
      },
      set: function(info) {
        this.updateValue({ info })
      }
    },
    time: {
      get: function() {
        return this.value.time
      },
      set: function(time) {
        this.updateValue({ time })
      }
    }
  },
	methods: {
    // 画像登録処理
    // -----------------------------------------------
    onFileChange: function(e) {
      // 選択された File の情報を保存しておく
      const fileList = e.target.files || e.dataTransfer.files;
      const files = [];
      for(let i = 0; i < fileList.length; i++){
        files.push(fileList[i]);
      }
      this.createImage(fileList[0]);
      this.$emit('updateFile', files);
    },
    // アップロードした画像を表示
    createImage: function(file) {
      const reader = new FileReader();
      reader.onload = e => {
        this.uploadedImage = e.target.result;
        this.$emit('updateImage', this.uploadedImage);
      };
      reader.readAsDataURL(file);
    },
    remove: function(){
      this.uploadedImage = false;
    },
    // 次のSTEPボタン
    nextStep: function(){
      if(this.$v.$invalid){
        console.log('バリデーションエラー');
      }else{
        this.$emit('nextStep');
      }
    },

    // アップデート
    updateValue: function(diff) {
      this.$emit('input', { ...this.value, ...diff })
    }
	}
}
</script>