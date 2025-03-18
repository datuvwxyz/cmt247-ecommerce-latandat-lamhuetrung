@extends('pages.main')
@section('content')
<section class="contact-us section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-12">
                <div class="contact-form-head">
                    <h3>Gửi tin nhắn cho chúng tôi</h3>
                    <form class="form" method="post" action="#">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <input name="name" type="text" placeholder="Họ tên">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input name="email" type="email" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input name="subject" type="text" placeholder="Tiêu đề">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group message">
                                    <textarea name="message" placeholder="Nội dung"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group button">
                                    <button type="submit" class="btn">Gửi tin nhắn</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="contact-info">
                    <div class="single-info">
                        <i class="fa fa-location-arrow"></i>
                        <h4>Địa chỉ</h4>
                        <p>18 Lâm Văn Vững - Phường 1 - Tp.Trà vinh</p>
                    </div>
                    <div class="single-info">
                        <i class="fa fa-phone"></i>
                        <h4>Điện thoại</h4>
                        <p>Hotline: (+84) 866 168 247</p>
                    </div>
                    <div class="single-info">
                        <i class="fa fa-envelope"></i>
                        <h4>Email</h4>
                        <p>thietbisocmt@gmail.com</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection