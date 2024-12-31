<template>
  <div>
    <a-switch
      :checked="theme === 'dark'"
      checked-children="Dark"
      un-checked-children="Light"
      @change="changeTheme"
    />
    <br />
    <br />
    <a-menu
      v-model:openKeys="openKeys"
      v-model:selectedKeys="selectedKeys"
      style="width: 256px"
      mode="inline"
      :theme="theme"
      :items="items"
      @select="handleChangePage"
    />
  </div>
</template>
<script setup>
import { h, ref } from "vue";
import {
  MailOutlined,
  CalendarOutlined,
  AppstoreOutlined,
  SettingOutlined,
} from "@ant-design/icons-vue";
import router from "@/router";
const theme = ref("dark");
const selectedKeys = ref(["1"]);
const openKeys = ref(["sub1"]);
const checked = ref("false");
const items = ref([
  {
    key: "1",
    icon: () => h(MailOutlined),
    label: "Navigation One",
    title: "Navigation One",
  },
  {
    key: "2",
    icon: () => h(CalendarOutlined),
    label: "Navigation Two",
    title: "Navigation Two",
  },
  {
    key: "sub1",
    icon: () => h(AppstoreOutlined),
    label: "Navigation Three",
    title: "Navigation Three",
    children: [
      {
        key: "3",
        label: "Option 3",
        title: "Option 3",
      },
      {
        key: "4",
        label: "Option 4",
        title: "Option 4",
      },
      {
        key: "sub1-2",
        label: "Submenu",
        title: "Submenu",
        children: [
          {
            key: "5",
            label: "Option 5",
            title: "Option 5",
          },
          {
            key: "6",
            label: "Option 6",
            title: "Option 6",
          },
        ],
      },
    ],
  },
  {
    key: "sub2",
    icon: () => h(SettingOutlined),
    label: "Navigation Four",
    title: "Navigation Four",
    children: [
      {
        key: "7",
        label: "Option 7",
        title: "Option 7",
      },
      {
        key: "8",
        label: "Option 8",
        title: "Option 8",
      },
      {
        key: "9",
        label: "Option 9",
        title: "Option 9",
      },
      {
        key: "10",
        label: "Option 10",
        title: "Option 10",
      },
    ],
  },
]);
const changeTheme = () => {
  //   console.log(theme.value, checked.value);
  checked.value = !checked.value;
  theme.value = checked.value ? "dark" : "light";
};
const findLabelByKey = (items, key) => {
  for (const item of items) {
    if (item.key === key) return item.label;
    if (item.children) {
      const label = findLabelByKey(item.children, key);
      if (label) return label;
    }
  }
  return null;
};

const handleChangePage = (event) => {
  const selectedKey = event.key;
  const label = findLabelByKey(items.value, selectedKey);
  console.log(label);
  const key = event.key;
  if (key === "1") {
    router.push("/TestPage");
    console.log("1");
  }
};
</script>
