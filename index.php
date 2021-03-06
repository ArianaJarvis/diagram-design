<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JO DB Design</title>
</head>
<body>
    <div class="mermaid">
        erDiagram
            Country ||--o{ User : has
            Country ||--o{ Banner_Info : has
            Country ||--o{ Promotion_Info : has
            Country ||--o{ Bank : has
                Country {
                    id int
                    country_code varchar
                    country_name varchar
                    currency varchar
                    language_code varchar
                }

            Lobby_Type ||--o{ Lobby : "belongs to"
                Lobby_Type {
                    id int
                    type varchar
                    description varchar
                }
            Lobby ||--o{ Merchant : has
            Lobby ||--o{ Authority_Group : has
                Lobby {
                    id int
                    user_id int
                    lobby_code varchar
                    lobby_type_id int
                }
            
            Merchant ||--|{ Merchant_Domain : contains
            Merchant ||--|{ App_Download_Domain : contains
            Merchant ||--o{ Banner : has
            Merchant ||--o{ Promotion : has
            Merchant ||--o{ News : has
            Merchant ||--o{ User : has
            Merchant ||--o{ Authority_Group : has
            Merchant ||--o{ Inbox_Message : has
            Merchant ||--o{ Bulletin_Announcement : has
            Merchant ||--o{ System_Announcement : has
            Merchant ||--o{ Merchant_Bank : has
            Merchant ||--o{ Withdrawal_Deposit_Log : has
            Merchant ||--o{ Member_Register_Setting : contains
            Merchant ||--o{ Winner_Setting : contains
            Merchant ||--o{ Main_Article : has
                Merchant {
                    id int
                    lobby_id int
                    merchant_code varchar
                    merchant_name varchar
                    meta_title varchar
                    logo varchar
                    icon varchar
                    customer_service_url varchar
                    country_id int
                }
        
                Merchant_Domain {
                    id int
                    merchant_id int
                    url varchar
                    status int
                    affiliate_id int
                    affiliate_binding_status boolean
                }

                App_Download_Domain {
                    id int
                    merchant_id int
                    url varchar
                }
            Banner ||--|{ Banner_Info : has
                Banner {
                    id int
                    merchant_id int
                    is_redirect int
                    redirect_url varchar
                    post_status varchar
                    sort int
                    publish_time datetime
                    is_deleted boolean
                }
            
                Banner_Info {
                    id int
                    banner_id int
                    country_id int
                    picture_mobile varchar
                    picture_pc varchar
                }
            
            Promotion ||--|{ Promotion_Info : has
                Promotion {
                    id int
                    merchant_id int
                    major_type_id int
                    sort int
                    post_status int
                    publish_time datetime
                    is_hot_event boolean
                }

                Promotion_Info {
                    id int
                    promotion_id int
                    country_id int
                    title varchar
                    mobile_header_image varchar
                    mobile_text_picture varchar
                    pc_header_image varchar
                    pc_text_picture varchar
                    hot_event_picture varchar
                    hot_redirect int
                    hot_url varchar
                }

                News {
                    id int
                    merchant_id int
                    title varchar
                    image_title varchar
                    sort int
                    post_status int
                    publish_time datetime
                    description text
                }

            Major_Type ||--o{ Promotion : "belongs to"
                Major_Type {
                    id int
                    name varchar
                    description varchar
                }
            
            User ||--o{ Affiliate : is
            User ||--o{ Member : is
            User ||--o{ Bank_Account : has
            User ||--o{ Member_Login_Log : has
            User ||--|{ Merchant_Bank_Transaction : modify
            User ||--|{ Withdrawal_Deposit_Log : handles
                User {
                    id int
                    merchant_id int
                    role_id int
                    username varchar
                    password varchar
                    full_name varchar
                    date_of_birth date
                    country_id int
                    contact_no varchar
                    contact_email varchar
                    register_date datetime
                    register_domain varchar
                    register_ip varchar
                    register_country_id int
                    register_device_type varchar
                    register_device_model varchar
                    last_login_date datetime
                    last_login_domain varchar
                    last_login_ip varchar
                    last_login_country_id int
                    last_login_device_type varchar
                    last_login_device_model varchar
                    error_count int
                }
            Affiliate ||--o{ Member : has
            Affiliate ||--o{ Affiliate : "related to"
            Affiliate ||--o{ Adjustment_Log : has
                Affiliate {
                    id int
                    user_id int
                    hierachy_level int
                    related_to int
                }
            Member ||--o{ Member : refers
            Member ||--o{ Member_Deposit : deposits
            Member ||--o{ Inbox_Message : has
            Member ||--o{ Withdrawal_Deposit_Log : has
            Member ||--o{ Adjustment_Log : has
            Member ||--o{ Winner_Setting : has
                Member {
                    id int
                    user_id int
                    kyc_status int
                    member_group_id int
                    highest_member_group_id int
                    account_status int
                    referral_id int
                    referral_code varchar
                    referral_source_id int
                    is_online boolean
                    affiliate_id int
                }

                Member_Deposit {
                    id int
                    member_id int
                    payment_method_id int
                    amount decimal
                    updated_at datetime
                    created_at datetime
                }

                Member_Login_Log {
                    id int
                    member_id int
                    device_model varchar
                    login_time datetime
                    device_type varchar
                    ip varchar
                    mac_address varchar
                    cookies varchar
                }

            Payment_Method ||--o{ Member_Deposit : "used by"
            Payment_Method ||--o{ Merchant_Bank : "used by"
            Payment_Method ||--o{ Withdrawal_Deposit_Log : "used by"
                Payment_Method {
                    id int
                    name varchar
                    description varchar
                }
            Referral_Source ||--o{ Member : from
                Referral_Source {
                    id int
                    name varchar
                }
            
            Member_Group ||--o{ Member : has
                Member_Group {
                    id int
                    level int
                    group_code varchar
                    group_name varchar
                    group_logo varchar
                    internal_remark varchar
                }
            
            Bank ||--o{ Bank_Account : has
            Bank ||--o{ Merchant_Bank : is
                Bank {
                    id int
                    bank_code varchar
                    bank_name varchar
                    country_id int
                }

                Bank_Account {
                    id int
                    user_id int
                    bank_id int
                    account_name varchar
                    account_no varchar
                    status boolean
                    is_verified boolean
                }

            Role ||--o{ Role_Permission : has
                Role ||--o{ Authority_Group : has
                Role ||--o{ User : has
                    Role {
                        id int
                        name varchar
                        code varchar
                    }
            
            Module ||--o{ Module : "is main module of"
                Module {
                    id int
                    code varchar
                    description varchar
                    main_module_id int
                }
            
            Permission ||--o{ Role_Permission : has
            Permission ||--|{ Module : use
                Permission {
                    id int
                    module_id int
                    description varchar
                }
        
                Role_Permission {
                    id int
                    role_id int
                    permission_id int
                }
                
            Authority_Group ||--o{ Authority : has
                Authority_Group {
                    id int
                    role_id int
                    lobby_id int
                    merchant_id int
                }
            
            Authority ||--|{ Authority_Action : has
                Authority {
                    id int
                    authority_group_id int
                    authority_action int
                    is_checked boolean
                }
        
                Authority_Action {
                    id int
                    action_name varchar
                    description varchar
                }

                Referral_Setting {
                    id int
                    merchant_id int
                    currency varchar
                    target_deposit_amount decimal
                    target_register_amount decimal
                    free_bet_for_referee int
                    expired_day datetime
                    referral_bonus decimal
                    invitation_bonus decimal
                }

                Inbox_Message {
                    id int
                    merchant_id int
                    member_id int
                    creator_id int
                    title varchar
                    content text
                    created_at datetime
                    is_read boolean
                    is_deleted boolean
                }

                Bulletin_Announcement {
                    id int
                    merchant_id int
                    title varchar
                    sort int
                    pin boolean
                    item text
                    description text
                    announcement_bar int
                    post_status int
                    publish_time datetime
                    updated_at datetime
                    created_at datetime
                    is_deleted boolean
                }
            
                System_Announcement {
                    id int
                    merchant_id int
                    lobby_id int
                    title varchar
                    description text
                    status int
                    publish_time datetime
                    updated_at datetime
                    created_at datetime
                    is_deleted boolean
                }

            Merchant_Bank ||--o{ Merchant_Bank_Transaction : has
                Merchant_Bank {
                    id int
                    merchant_id int
                    bank_id int
                    branch varchar
                    bank_currency varchar
                    account_name varchar
                    account_no varchar
                    transaction_type varchar
                    payment_method_id int
                    bank_status int
                    min_balance decimal
                    max_balance decimal
                    current_balance decimal
                    bank_seq int
                    maintenance_start datetime
                    maintenance_end datetime
                    updated_at datetime
                    created_at datetime
                }

                Merchant_Bank_Transaction {
                    id int
                    merchant_bank_id int
                    transaction_type varchar
                    amount decimal
                    processing_fee decimal
                    balance decimal
                    remark varchar
                    last_modified_by int
                    created_at datetime
                }

                Withdrawal_Deposit_Log {
                    id int
                    payment_method_id int
                    status int
                    merchant_id int
                    member_id int
                    currency varchar
                    deposit_amount decimal
                    processing_fee decimal
                    confirmed_amount decimal
                    member_bank varchar
                    member_account varchar
                    merchant_bank_id int
                    remark varchar
                    reference varchar
                    created_at datetime
                    processing_time datetime
                    approved_time datetime
                    handled_by int
                }

                Adjustment_Log {
                    id int
                    member_id int
                    affiliate_id int
                    currency varchar
                    adjust_amount decimal
                    adjustment_type int
                    adjustment_from int
                    status int
                    remark varchar
                    handled_by int
                    modified_date datetime
                    created_at datetime
                }

                Member_Register_Setting {
                    id int
                    merchant_id int
                    register_type varchar
                    option_selected int
                }

                Winner_Setting {
                    id int
                    merchant_id int
                    member_id int
                    game_id int
                    member_account_id int
                    winning_amount decimal
                    sort int
                }

            Article_Section ||--o{ Main_Article : has
                Article_Section {
                    id int
                    content_title varchar
                    sort int
                }

            Main_Article ||--o{ Sub_Article : has
                Main_Article {
                    id int
                    merchant_id int
                    article_section_id int
                    sort int
                    is_active boolean
                    title varchar
                }
                
                Sub_Article {
                    id int
                    main_article_id int
                    sort int
                    is_active boolean
                    subtitle varchar
                    description text
                }
            
    </div>
    <script src="https://cdn.jsdelivr.net/npm/mermaid/dist/mermaid.min.js">
        mermaid.initialize({startOnLoad:true});
    </script>
</body>
</html>
