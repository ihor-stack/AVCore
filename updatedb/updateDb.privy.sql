alter table bans drop FOREIGN KEY fk_Ban_users;
ALTER TABLE bans
    ADD CONSTRAINT fk_Ban_users FOREIGN KEY
    fk_Ban_users_idx (users_id)
    REFERENCES users (id)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

alter table audit drop FOREIGN KEY fk_audit_users;
ALTER TABLE audit
    ADD CONSTRAINT fk_audit_users FOREIGN KEY
    fk_audit_users_idx (users_id)
    REFERENCES users (id)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

alter table live_transmitions drop FOREIGN KEY fk_live_transmitions_users1;
ALTER TABLE live_transmitions
    ADD CONSTRAINT fk_live_transmitions_users1 FOREIGN KEY
    fk_live_transmitions_users1_idx (users_id)
    REFERENCES users (id)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

alter table users_login_history drop FOREIGN KEY fk_users_login_history_users1;
ALTER TABLE users_login_history
    ADD CONSTRAINT fk_users_login_history_users1 FOREIGN KEY
    fk_users_login_history_users1_idx (users_id)
    REFERENCES users (id)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

alter table wallet drop FOREIGN KEY fk_wallet_users;
ALTER TABLE wallet
    ADD CONSTRAINT fk_wallet_users FOREIGN KEY
    fk_wallet_users_idx (users_id)
    REFERENCES users (id)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

alter table wallet_log drop FOREIGN KEY fk_wallet_log_wallet;
ALTER TABLE wallet_log
    ADD CONSTRAINT fk_wallet_log_wallet FOREIGN KEY
    fk_wallet_log_wallet1_idx (wallet_id)
    REFERENCES wallet (id)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

alter table ppvlive_purchases drop FOREIGN KEY fk_ppvlive_purchases_users1;
ALTER TABLE ppvlive_purchases
    ADD CONSTRAINT fk_ppvlive_purchases_users1 FOREIGN KEY
    fk_ppvlive_purchases_users1_idx (users_id)
    REFERENCES users (id)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

alter table users add column studioId int(11) default null after analyticsCode;