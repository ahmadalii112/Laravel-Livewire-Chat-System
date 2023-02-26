<div>
    <div class="chatbox_header">
        <div class="return">
            <i class="bi bi-arrow-left"></i>
        </div>

        <div class="img_container">
            <img src="https://picsum.photos/id/231/200/300" alt="">
        </div>

        <div class="name">Ali</div>

        <div class="info">
            <div class="info_item">
                <i class="bi bi-telephone-fill"></i>
            </div>
            <div class="info_item">
                <i class="bi bi-image"></i>
            </div>
            <div class="info_item">
                <i class="bi bi-info-circle-fill"></i>
            </div>
        </div>
    </div>
    <div class="chatbox_body">
        <div class="msg_body msg_body_receiver">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae doloribus earum, excepturi id, modi
            necessitatibus nemo obcaecati odio porro quam quia sed similique sit, tempore unde veritatis vitae. Dolorum,
            sed! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad adipisci aliquam animi asperiores
            aspernatur assumenda delectus doloremque ex illo itaque laudantium maxime minima minus odit quibusdam,
            reprehenderit similique tempora totam! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad, at,
            atque aut autem distinctio eos excepturi id inventore itaque, iusto laborum nobis nulla officiis ratione
            recusandae soluta velit. Ipsa, iure.
            <div class="msg_body_footer">
                <div class="date">
                    5 hours ago
                </div>
                <div class="read">
                    <i class="bi bi-check"></i>
                </div>
            </div>
        </div>
        @foreach(range(1,3) as $data)
            <div class="msg_body msg_body_me">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae doloribus earum, excepturi id, modi
                necessitatibus nemo obcaecati odio porro quam quia sed similique sit, tempore unde veritatis vitae.
                Dolorum, sed! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad adipisci aliquam animi
                asperiores aspernatur assumenda delectus doloremque ex illo itaque laudantium maxime minima minus odit
                quibusdam, reprehenderit similique tempora totam! Lorem ipsum dolor sit amet, consectetur adipisicing
                elit. Ad, at, atque aut autem distinctio eos excepturi id inventore itaque, iusto laborum nobis nulla
                officiis ratione recusandae soluta velit. Ipsa, iure.
                <div class="msg_body_footer">
                    <div class="date">
                        5 hours ago
                    </div>
                    <div class="read">
                        <i class="bi bi-check"></i>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</div>
