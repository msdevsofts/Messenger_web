"use strict";

let Profile = {
    memberId: 0,
    set MEMBER_ID(val) {
        this.memberId = val;
    },
    get MEMBER_ID() {
        return this.memberId;
    },

    uniqueId: '',
    set UNIQUE_ID(val) {
        this.uniqueId = val;
    },
    get UNIQUE_ID() {
        return this.uniqueId;
    },

    nickname: Default.NICKNAME,
    set NICKNAME(val) {
        if (val.isEmpty()) return;
        this.nickname = val;
    },
    get NICKNAME() {
        return this.nickname;
    },

    sex: 0,
    set SEX(val) {
        this.sex = val;
    },
    get SEX() {
        return this.sex;
    }
};
