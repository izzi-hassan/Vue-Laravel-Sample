<template>
    <div class="cover-image-uploader">
        <div class="row hide show-image-upload-container align-center">
            <div class="small-4 columns"></div>
            <div class="small-4 columns">
                <div class="row align-center align-middle shrink full-height">
                    <div class="shrink columns">
                        <button class="mdl-button show-image-upload-button" v-on:click="showImageUpload">Add a cover image</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="cover-image-upload-container">
            <div class="row hide remove-image-container">
                <div class="small-10 columns"></div>
                <div class="small-2 columns">
                    <div class="row align-center align-middle shrink full-height">
                        <div class="shrink columns">
                            <button aria-label="Remove Image" type="button" class="light-close" v-on:click="remove">
                                <i aria-hidden="true" class="fa fa-close"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
                <div class="row hide-image-upload-container">
                <div class="small-10 columns"></div>
                <div class="small-2 columns">
                    <div class="row align-center align-middle align-center shrink full-height">
                        <div class="shrink columns">
                            <button aria-label="No Cover Image" type="button" class="light-close" v-on:click="hideImageUpload">
                                <i aria-hidden="true" class="fa fa-close"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row align-middle">
                <div class="columns"></div>
                <div class="shrink columns upload-button-container text-center" @click="upload">
                    <i class="fa fa-picture-o"></i><br />
                    <input type="file" @change="onFileChange" style="" class="file-upload-input hide" />
                    <input type="hidden" name="cover_image" />
                    <button class="mdl-button faux-upload-button" >Upload a cover image</button>
                </div>
                <div class="columns"></div>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        data() {
            return {
                image: ''
            }
        },
        methods: {
            onFileChange(e) {
                var files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;

                var reader = new FileReader();

                reader.onload = (e) => {
                    this.image = e.target.result;

                    axios.post('/api/util/image/upload', {image: this.image})
                    .then(function(response) {
                        if (! response.data.error) {
                            $('.cover-image-upload-container').css('background-image', "url('/images/uploads/" + response.data.filename + "')");
                            $('.remove-image-container').removeClass('hide');
                            $('.hide-image-upload-container').addClass('hide');
                            $('.upload-button-container').hide();

                            $('input[name="cover_image"]:first').val('/images/uploads/' + response.data.filename);

                            showToast('Cover Image Uploaded');
                        } else {
                            showToast('Something went wrong');
                        }
                    }).catch(function(error) {
                        showToast(error.message);
                    });
                };
                reader.readAsDataURL(files[0]);
            },
            remove: function (e) {
                this.image = '';
                $('.cover-image-upload-container').css('background-image', "url('/images/shared/image-upload-bg.jpg')");
                $('.upload-button-container').show();
                $('.remove-image-container').addClass('hide');
                $('.hide-image-upload-container').removeClass('hide');
                $('input[name="cover_image"]').val('');
            },
            upload() {
                $('.cover-image-upload-container').show();
                $('.upload-button-container .file-upload-input').click();
            },
            hideImageUpload() {
                $('.cover-image-upload-container').hide();
                $('.show-image-upload-container').removeClass('hide');
            },
            showImageUpload() {
                $('.cover-image-upload-container').show();
                $('.show-image-upload-container').addClass('hide');
            }
        }
    }
</script>