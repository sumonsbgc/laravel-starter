@extends('layouts.admin_app')

@section('content')
    <div class="content">
        @include('admin.partials.page_title')

        <div class="flex mb-1">
            <div class="col-3">
                <div class="card shadow-none bg-transparent">
                    <div class="tab-container">
                        <ul class="tab-filter setting-filter flex-column">
                            <li class=""><a class="active" href="javascript:void" data-target="general">General</a></li>
                            <li class=""><a class="" href="javascript:void" data-target="logo_favicon">Logo & Favicon</a></li>
                            <li class=""><a class="" href="javascript:void" data-target="footer_seo">Footer & SEO</a></li>
                            <li class=""><a class="" href="javascript:void" data-target="social">Social Links</a></li>
                            <li class=""><a class="" href="javascript:void" data-target="analytics">Analytics</a></li>
                            <li class=""><a class="" href="javascript:void" data-target="payment">Payment</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-9">
                <div class="card">
                    <div class="card-header bg-purple">
                        {{ 'All Settings' }}
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.setting.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="tab-container">
                                <div class="tab-content">
                                    <div class="tab-section" id="general">
                                        <h4 class="setting-section-title mb-2">{{ 'General' }}</h4>

                                        <div class="flex mb-1 flex-nowrap">
                                            <label for="site_name" class="label col-3">Site Name</label>
                                            <input type="text" name="site_name" class="input-control col-9" id="site_name" placeholder="Enter Site Name">
                                        </div>
                                        <div class="flex mb-1 flex-nowrap">
                                            <label for="site_title" class="label col-3">Site Title</label>
                                            <input type="text" name="site_title" class="input-control col-9" id="site_title" placeholder="Enter Site Title">
                                        </div>
                                        <div class="flex mb-1 flex-nowrap">
                                            <label for="mail_address" class="label col-3">Mail Address</label>
                                            <input type="text" name="mail_address" class="input-control col-9" id="mail_address" placeholder="Mail Address">
                                        </div>
                                        <div class="flex mb-1 flex-nowrap">
                                            <label for="currency_code" class="label col-3">Currency Code</label>
                                            <input type="text" name="currency_code" class="input-control col-9" id="currency_code" placeholder="Currency Code">
                                        </div>
                                        <div class="flex mb-1 flex-nowrap">
                                            <label for="currency_symbol" class="label col-3">Currency Symbol</label>
                                            <input type="text" name="currency_symbol" class="input-control col-9" id="currency_symbol" placeholder="Currency Symbol">
                                        </div>
                                    </div>
                                    <div class="tab-section" id="logo_favicon">
                                        <h4 class="setting-section-title mb-2">{{ 'Logo & Favicon' }}</h4>                                        
                                        <div class="flex mb-1 flex-nowrap">
                                            <div class="col-3">
                                                <div class="settings_img_box">
                                                    <img src="{{ asset('assets/images/admin-logo.svg') }}" alt="{{ "Site Title" }}" class="">
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <label for="site_logo" class="label">Site Logo</label>
                                                <input type="file" name="site_logo" class="input-control" id="site_logo">
                                            </div>
                                        </div>
                                        <div class="flex mb-1 flex-nowrap">
                                            <div class="col-3">
                                                <div class="settings_img_box">
                                                    <img src="{{ asset('assets/images/admin-logo.svg') }}" alt="{{ "Site Favicon" }}" class="">
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <label for="site_favicon" class="label">Site Favicon</label>
                                                <input type="file" name="site_favicon" class="input-control" id="site_favicon">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-section" id="footer_seo">
                                        <h4 class="setting-section-title mb-2">{{ 'Footer & SEO' }}</h4>

                                        <div class="flex mb-1 flex-nowrap">
                                            <label for="copyright_text" class="label col-3">Copyright Text</label>
                                            <textarea name="copyright_text" id="copyright_text" class="text-control col-9" placeholder="Copyright Text"></textarea>
                                        </div>
                                        
                                        <div class="flex mb-1 flex-nowrap">
                                            <label for="meta_title" class="label col-3">SEO Meta Title</label>
                                            <input type="text" name="meta_title" id="meta_title" class="input-control col-9" placeholder="SEO Meta Title">
                                        </div>

                                        <div class="flex mb-1 flex-nowrap">
                                            <label for="meta_description" class="label col-3">Meta Description</label>
                                            <textarea name="meta_description" id="meta_description" class="text-control col-9" placeholder="Meta Description"></textarea>
                                        </div>
                                    </div>
                                    <div class="tab-section" id="social">
                                        <h4 class="setting-section-title mb-2">{{ 'Social Link' }}</h4>

                                        <div class="flex mb-1 flex-nowrap">
                                            <label for="facebook" class="label col-3">Facebook</label>
                                            <input name="facebook" id="facebook" class="input-control col-9" placeholder="Facebook Url">
                                        </div>
                                        <div class="flex mb-1 flex-nowrap">
                                            <label for="twitter" class="label col-3">Twitter</label>
                                            <input name="twitter" id="twitter" class="input-control col-9" placeholder="Twitter Url">
                                        </div>
                                        <div class="flex mb-1 flex-nowrap">
                                            <label for="instagram" class="label col-3">Instagram</label>
                                            <input name="instagram" id="instagram" class="input-control col-9" placeholder="Instagram Url">
                                        </div>
                                    </div>
                                    <div class="tab-section" id="analytics">
                                        <h4 class="setting-section-title mb-2">{{ 'Analytics' }}</h4>

                                        <div class="flex mb-1 flex-nowrap">
                                            <label for="google_analytic_code" class="label col-3">Google Analytics Code</label>
                                            <textarea name="google_analytic_code" id="google_analytic_code" class="text-control col-9" placeholder="Google Analytics Code"></textarea>
                                        </div>
                                        
                                        <div class="flex mb-1 flex-nowrap">
                                            <label for="facebook_analytic_code" class="label col-3">Facebook Analytics Code</label>
                                            <textarea name="facebook_analytic_code" id="facebook_analytic_code" class="text-control col-9" placeholder="Facebook Analytics Code"></textarea>
                                        </div>
                                    </div>
                                    <div class="tab-section" id="payment">
                                        <h4 class="setting-section-title mb-2">{{ 'Strip Settings' }}</h4>

                                        <div class="flex mb-1 flex-nowrap">
                                            <label for="stripe_payment_method" class="label col-3">Stripe Payment Method</label>
                                            <select name="stripe_payment_method" id="stripe_payment_method" class="select-control col-9">
                                                <option value="0">Disabled</option>
                                                <option value="1">Enabled</option>
                                            </select>
                                        </div>

                                        <div class="flex mb-1 flex-nowrap">
                                            <label for="stripe_app_id" class="label col-3">Stripe App ID</label>
                                            <input name="stripe_app_id" id="stripe_app_id" class="input-control col-9" placeholder="Stripe App ID">
                                        </div>

                                        <div class="flex mb-1 flex-nowrap">
                                            <label for="stripe_secret_key" class="label col-3">Stripe Secret Key</label>
                                            <input name="stripe_secret_key" id="stripe_secret_key" class="input-control col-9" placeholder="Stripe Secret Key">
                                        </div>

                                        <h4 class="setting-section-title mb-2">{{ 'Paypal Settings' }}</h4>
                                        <div class="flex mb-1 flex-nowrap">
                                            <label for="paypal_payment_method" class="label col-3">Paypal Payment Method</label>
                                            <select name="paypal_payment_method" id="paypal_payment_method" class="select-control col-9">
                                                <option value="0">Disabled</option>
                                                <option value="1">Enabled</option>
                                            </select>
                                        </div>

                                        <div class="flex mb-1 flex-nowrap">
                                            <label for="paypal_app_id" class="label col-3">Paypal App ID</label>
                                            <input name="paypal_app_id" id="paypal_app_id" class="input-control col-9" placeholder="Paypal App ID">
                                        </div>

                                        <div class="flex mb-1 flex-nowrap">
                                            <label for="paypal_secret_key" class="label col-3">Paypal Secret Key</label>
                                            <input name="paypal_secret_key" id="paypal_secret_key" class="input-control col-9" placeholder="Paypal Secret Key">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex mb-1">
                                <div class="col-3"></div>
                                <div class="col-9 text-right">
                                    <input type="submit" class="submit-control" value="Save">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>

        </div>
    </div>
@endsection
