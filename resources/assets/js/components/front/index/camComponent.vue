
<template>

    <video-player class="vjs-custom-skin"
                  :options="playerOptions"
                  @ready="playerReadied">
    </video-player>

</template>

<script>

    // hls plugin for videojs6
    require('videojs-contrib-hls/dist/videojs-contrib-hls.js')
    // export
    export default {
        data() {
            return {
                playerOptions: {
                    // videojs and plugin options
                    width: '420',
                    height: '300',
                    sources: [{
                        withCredentials: false,
                        type: "application/x-mpegURL",
                        src: "https://logos-channel.scaleengine.net/logos-channel/live/biblescreen-ad-free/playlist.m3u8"
                    }],
                    controlBar: {
                        timeDivider: false,
                        durationDisplay: false
                    },
                    flash: { hls: { withCredentials: false }},
                    html5: { hls: { withCredentials: false }},
                    poster: "https://surmon-china.github.io/vue-quill-editor/static/images/surmon-5.jpg"
                }
            }
        },
        methods: {
            playerReadied(player) {
                var hls = player.tech({ IWillNotUseThisInPlugins: true }).hls
                player.tech_.hls.xhr.beforeRequest = function(options) {
                    // console.log(options)
                    return options
                }
            }
        }
    }
    </script>
