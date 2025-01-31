<div class="wrap">
    <h1>Pool Mat Settings</h1>
    <div class="wc-cd-management">
        <?php 
            do_action('wc-cd-settings'); 
            $settings = wc_cd_get_settings();
        ?>
        <form method="POST">
            <div class="wc-cd-field">
                <div class="icon">
                    <svg style="width:50px" id="Capa_1" style="enable-background:new 0 0 60.013 60.013;" version="1.1" viewBox="0 0 60.013 60.013" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M11.68,12.506l-0.832-5h-2.99c-0.447-1.72-1.999-3-3.858-3c-2.206,0-4,1.794-4,4s1.794,4,4,4c1.859,0,3.411-1.28,3.858-3  h1.294l0.5,3H9.624l0.222,1.161l0,0.003c0,0,0,0,0,0l2.559,13.374l1.044,5.462h0.001l1.342,7.015  c-2.468,0.186-4.525,2.084-4.768,4.475c-0.142,1.405,0.32,2.812,1.268,3.858c0.949,1.05,2.301,1.652,3.707,1.652h2  c0,3.309,2.691,6,6,6s6-2.691,6-6h11c0,3.309,2.691,6,6,6s6-2.691,6-6h4c0.553,0,1-0.447,1-1s-0.447-1-1-1h-4.35  c-0.826-2.327-3.043-4-5.65-4s-4.824,1.673-5.65,4h-11.7c-0.826-2.327-3.043-4-5.65-4s-4.824,1.673-5.65,4H15  c-0.842,0-1.652-0.362-2.224-0.993c-0.577-0.639-0.848-1.461-0.761-2.316c0.152-1.509,1.546-2.69,3.173-2.69h0.781  c0.02,0,0.038,0,0.06,0l6.128-0.002L33,41.501v-0.001l7.145-0.002L51,41.496v-0.001l4.024-0.001c2.751,0,4.988-2.237,4.988-4.987  V12.494L11.68,12.506z M4,10.506c-1.103,0-2-0.897-2-2s0.897-2,2-2s2,0.897,2,2S5.103,10.506,4,10.506z M46,45.506  c2.206,0,4,1.794,4,4s-1.794,4-4,4s-4-1.794-4-4S43.794,45.506,46,45.506z M23,45.506c2.206,0,4,1.794,4,4s-1.794,4-4,4  s-4-1.794-4-4S20.794,45.506,23,45.506z M58.013,21.506H51v-7.011l7.013-0.002V21.506z M42,39.498v-6.991h7v6.989L42,39.498z   M42,30.506v-7h7v7H42z M24,39.503v-6.997h7v6.995L24,39.503z M24,30.506v-7h7v7H24z M13.765,23.506H22v7h-6.895L13.765,23.506z   M49,21.506h-7v-7h7V21.506z M40,21.506h-7V14.5l7-0.002V21.506z M31,14.506v7h-7v-7H31z M33,23.506h7v7h-7V23.506z M51,23.506h7v7  h-7V23.506z M22,14.504v7.003h-8.618l-1.34-7L22,14.504z M15.487,32.506H22v6.997l-5.173,0.002L15.487,32.506z M33,32.506h7v6.992  L33,39.5V32.506z M55.024,39.494L51,39.495v-6.989h7.013v4C58.013,38.154,56.672,39.494,55.024,39.494z"/><g/><g/><g/><g/><g/><g/><g/><g/><g/><g/><g/><g/><g/><g/><g/></svg>
                </div>
                <div class="field-group">
                    <div class="field">
                        <span class="label">Target Product ID:</span>
                        <span class="input-group">
                            <input type="number" name="wc-cd[product-id]" value="<?php echo $settings['product-id'] ?>" placeholder="0">
                            <span>
                                <svg style="width:25px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><defs><style>.cls-1,.cls-2{fill:none;}.cls-2{stroke:#000;stroke-linecap:round;stroke-linejoin:round;}</style></defs><g data-name="Layer 2" id="Layer_2"><g id="Workspace"><rect class="cls-1" height="24" width="24"/><rect class="cls-2" height="9" width="10" x="7" y="9"/><path class="cls-2" d="M10,10V8a2,2,0,0,1,2-2h0a2,2,0,0,1,2,2v2"/></g></g></svg>
                            </span>
                        </span>
                    </div>
                    <div class="field">
                        <span class="label">Target Element:</span>
                        <span class="input-group">
                            <input type="text" name="wc-cd[target-element-id]" value="<?php echo $settings['target-element-id'] ?>">
                            <span>
                                <svg height="10px" id="Layer_1" style="enable-background:new 0 0 32 32;" version="1.1" viewBox="0 0 32 32" width="10px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M14,6c0-0.984-0.813-2-2-2c-0.531,0-0.994,0.193-1.38,0.58l-9.958,9.958C0.334,14.866,0,15.271,0,16s0.279,1.08,0.646,1.447  l9.974,9.973C11.006,27.807,11.469,28,12,28c1.188,0,2-1.016,2-2c0-0.516-0.186-0.986-0.58-1.38L4.8,16l8.62-8.62  C13.814,6.986,14,6.516,14,6z M31.338,14.538L21.38,4.58C20.994,4.193,20.531,4,20,4c-1.188,0-2,1.016-2,2  c0,0.516,0.186,0.986,0.58,1.38L27.2,16l-8.62,8.62C18.186,25.014,18,25.484,18,26c0,0.984,0.813,2,2,2  c0.531,0,0.994-0.193,1.38-0.58l9.974-9.973C31.721,17.08,32,16.729,32,16S31.666,14.866,31.338,14.538z"/></svg>
                            </span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="wc-cd-field">
                <div class="icon">
                    <span class="price">₪</span>
                </div>
                <div class="field-group">
                    <div class="field">
                        <span class="label">Price per sqm:</span>
                        <span class="input-group">
                            <input type="number" name="wc-cd[price]" value="<?php echo $settings['price'] ?>" placeholder="0">
                            <span>₪</span>
                        </span>
                    </div>
                    <div class="field">
                        <span class="label">Cutting per sqm:</span>
                        <span class="input-group">
                            <input type="number" name="wc-cd[cutting-price]" value="<?php echo $settings['cutting-price'] ?>" placeholder="0">
                            <span>₪</span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="wc-cd-field">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="design" viewBox="0 0 100 100" style="enable-background:new 0 0 100 100;" xml:space="preserve">
                        <style type="text/css">.st0{fill:#333333;}.st1{fill:#D5FFA2;}</style>
                        <g><path class="st0" d="M76,44.3c-0.2-0.2-0.5-0.3-0.7-0.3h0l-26.4,0c-14.2,0-25.3-4.2-25.3-9.5c0-4,6.7-8.2,19-8.2   c12.8,0,18.5,3.3,18.5,6.6c0,3.6-5.6,5.3-11.1,5.5v-8.8c0-0.6-0.5-1.1-1.1-1.1c-6.9,0-14.3,2.1-14.3,6.6v4.2c0,0.6,0.5,1.1,1.1,1.1   s1.1-0.5,1.1-1.1V38c2.7,1.6,7.5,2.5,12.1,2.5c4.4,0,9.4-0.9,12.1-3.2v3.4c0,0.6,0.5,1.1,1.1,1.1s1.1-0.5,1.1-1.1v-7.8   c0-5.5-7.7-8.8-20.6-8.8c-13.8,0-21.1,5.2-21.1,10.3c0,0,0,0,0,0v0v0.4v32c0,6.9,11.8,12.1,27.5,12.1h26.4c0.6,0,1.1-0.5,1.1-1.1   V45C76.3,44.7,76.2,44.5,76,44.3z M36.7,35.1c0-2.3,4.9-4.2,11.1-4.4v7.7C40.9,38.2,36.7,36.1,36.7,35.1z M74.2,77h-6.7V61.5   c0-0.6-0.5-1.1-1.1-1.1s-1.1,0.5-1.1,1.1V77h-6.7V61.5c0-0.6-0.5-1.1-1.1-1.1s-1.1,0.5-1.1,1.1V77h-6.7V56c0-0.6-0.5-1.1-1.1-1.1   s-1.1,0.5-1.1,1.1V77c-2.3,0-4.6-0.2-6.7-0.5V61c0-0.6-0.5-1.1-1.1-1.1S39,60.4,39,61v15.2c-2.4-0.4-4.7-1-6.7-1.7V59   c0-0.6-0.5-1.1-1.1-1.1s-1.1,0.5-1.1,1.1v14.7c-4.1-1.8-6.7-4.2-6.7-6.8V39.3c4,4.2,13.3,6.8,25.3,6.8l25.3,0V77z"/><path class="st1" d="M79.5,27c-3.6,0-6.5,2.9-6.5,6.5c0,0,0,0,0,0c0-3.6-2.9-6.5-6.5-6.5c3.6,0,6.5-2.9,6.5-6.5c0,0,0,0,0,0   C73,24.1,75.9,26.9,79.5,27z"/></g>
                    </svg>
                </div>
                <div class="field-group">
                    <div class="field">
                        <span class="label">Maximum width:</span>
                        <span class="input-group">
                            <input type="number" name="wc-cd[max-width]" value="<?php echo $settings['max-width'] ?>" placeholder="0">
                            <span>cm</span>
                        </span>                        
                    </div>
                    <div class="field">
                        <span class="label">Maximum length:</span>                        
                        <span class="input-group">
                            <input type="number" name="wc-cd[max-length]" value="<?php echo $settings['max-length'] ?>" placeholder="0">
                            <span>cm</span>
                        </span> 
                    </div>
                </div>
            </div>
            <div class="wc-cd-cta">
                <button class="button button-primary">
                    <span>Save Settings</span>
                </button>
            </div>
        </form>
    </div>
</div>