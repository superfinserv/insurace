<section class="experiment recordrtc">
        <h2 class="header">
            <select class="recording-media">
                <option value="record-video">Video</option>
                <option value="record-audio">Audio</option>
                <option value="record-screen">Screen</option>
            </select>

            into
            <select class="media-container-format">
                <option>WebM</option>
                <option disabled>Mp4</option>
                <option disabled>WAV</option>
                <option disabled>Ogg</option>
                <option>Gif</option>
            </select>

            <button>Start Recording</button>
        </h2>

        <div style="text-align: center;">
            <form method="get" action="" enctype="multipart/form-data">
            <button id="save-to-disk">Save To Disk</button>
            <button id="open-new-tab">Open New Tab</button>
            <button id="upload-to-server">Upload To Server</button>
            </form>
        </div>

        <br>

        <video controls muted></video>
    </section>