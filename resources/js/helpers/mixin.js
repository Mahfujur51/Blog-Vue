import Vue from "vue"
Vue.mixin({
    methods:{
        confirm:function (callback) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) callback();
            })

        },
        loadImage:function (e) {
            let file=e.target.files[0];
            if (file.size<10485760){
                let reader = new FileReader();
                let test=this;
                reader.onload = function(e) {
                    // The file's text will be printed here
                    test.form.image=e.target.result;
                };
                reader.readAsDataURL(file);
            }else {
                toastr.error("Image Size is too large");
            }


        },
    fileLink:function (name){

            if( name!=null && name.length<256)
                return 'assets/fontend/post/'+name;
            else
                return  this.form.image;


    }
    }
})
