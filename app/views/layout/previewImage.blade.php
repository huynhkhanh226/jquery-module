<!-- The Modal -->
<div id="modalImage" class="modal">
    <span class="close" onclick="document.getElementById('modalImage').style.display='none'">&times;</span>
    <img class="modal-content" id="idPreviewImage">
    <div id="idCaption"></div>
</div>
<style>
    #modalImage>img {
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    /*#modalImage>img:hover {opacity: 0.7;}*/

    /* The Modal (background) */
    #modalImage {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 100000000000; /* Sit on top */
        padding-top: 30px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
    }

    /* Modal Content (Image) */
    #modalImage .modal-content {
        margin: auto;
        display: block;
        /*width: 80%;
        max-width: 700px;*/
        width: 90%;
        max-width: 900px;

    }

    /* Caption of Modal Image (Image Text) - Same Width as the Image */
    #modalImage #caption {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 150px;
    }

    /* Add Animation - Zoom in the Modal */
    #modalImage .modal-content, #caption {
        -webkit-animation-name: zoom;
        -webkit-animation-duration: 0.6s;
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    @-webkit-keyframes zoom {
        from {-webkit-transform:scale(0)}
        to {-webkit-transform:scale(1)}
    }

    @keyframes zoom {
        from {transform:scale(0)}
        to {transform:scale(1)}
    }

    /* The Close Button */
    #modalImage .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
        background-color: transparent;
    }

    #modalImage .close:hover,
    #modalImage .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px){
        .modal-content {
            width: 100%;
        }
    }
</style>


<script>
    function previewImage(el){
        //console.log("test");
        $("#modalImage").css("display","block");
        console.log("test");
        $("#idPreviewImage").attr("src",$(el).attr("longdesc"));
        $("#idCaption").html(el.alt);
    }
</script>