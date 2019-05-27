<template>
    <div class="container">
      <div class="filezone" v-if="files.length > 0">
        <div v-for="(file, key) in files" class="file-listing">
            <img class="preview" v-bind:ref="'preview'+parseInt(key)"/>
            {{ file.name }}
            <div class="success-container" v-if="file.id > 0">
                Success
            </div>
            <div class="remove-container" v-else>
                <a class="remove" v-on:click="removeFile(key)">Remove</a>
            </div>
        </div>
      </div>
      <div class="filezone" v-else>
          <input type="file" id="files" ref="files" multiple v-on:change="handleFiles()"/>
          <p>
              Drop your files here <br>or click to search
          </p>
      </div>

        <a class="submit-button" v-on:click="submitFiles()" v-show="files.length > 0">Submit</a>
        <a class="profile-button" href="/user/profile">Back To Profile</a>
    </div>
</template>

<script>
    export default {
      data() {
        return {
          files: []
        }
      },
      methods: {
        // your methods here
        handleFiles() {
          let uploadedFiles = this.$refs.files.files;

          for(var i = 0; i < uploadedFiles.length; i++) {
            this.files.push(uploadedFiles[i]);
          }
          this.getImagePreviews();
        },

        getImagePreviews(){
          for( let i = 0; i < this.files.length; i++ ){
            if ( /\.(jpe?g|png|gif)$/i.test( this.files[i].name ) ) {
              let reader = new FileReader();
              reader.addEventListener("load", function(){
                this.$refs['preview'+parseInt(i)][0].src = reader.result;
              }.bind(this), false);
              reader.readAsDataURL( this.files[i] );
            }else{
              this.$nextTick(function(){
                this.$refs['preview'+parseInt(i)][0].src = '/img/generic.png';
              });
            }
          }
        },

        removeFile( key ){
          this.files.splice( key, 1 );
          this.getImagePreviews();
        },

        submitFiles() {
          for( let i = 0; i < this.files.length; i++ ){
            if(this.files[i].id) {
              continue;
            }
            let formData = new FormData();
            formData.append('file', this.files[i]);

            axios.post('/profile-image/store',
            formData,
            {
              headers: {
                'Content-Type': 'multipart/form-data'
              }
            }
          ).then(function(data) {
            this.files[i].id = data['data']['id'];
            this.files.splice(i, 1, this.files[i]);
            console.log('success');
          }.bind(this)).catch(function(data) {
            console.log('error');
          });
        }
      }

      }
    }
</script>
