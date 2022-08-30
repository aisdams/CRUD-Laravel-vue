import { createRouter, createWebHistory } from "vue-router";
import Dashboard from "@/views/Dashboard.vue";
import Billing from "@/views/Billing.vue";
import VirtualReality from "@/views/VirtualReality.vue";
import Profile from "@/views/Profile.vue";
import Rtl from "@/views/Rtl.vue";
import SignIn from "@/views/SignIn.vue";
import SignUp from "@/views/SignUp.vue";

const routes = [
  {
    path: "/",
    name: "/",
    redirect: "/dashboard",
  },
  {
    path: "/dashboard",
    name: "Dashboard",
    component: Dashboard,
  },
  {
    path: "/catatan",
    name: "catatan.index",
    component: () => import( /* webpackChunkName: "catatan.index" */ '@/views/catatan/Index.vue')
  },
  {
    path: "/create",
    name: "catatan.create",
    component: () => import( /* webpackChunkName: "catatan.create" */ '@/views/catatan/Create.vue')
  },
  {
    path: "/edit",
    name: "catatan.edit",
    component: () => import( /* webpackChunkName: "catatan.edit" */ '@/views/catatan/Edit.vue')
  },
  {
    path: "/billing",
    name: "Billing",
    component: Billing,
  },
  {
    path: "/virtual-reality",
    name: "Virtual Reality",
    component: VirtualReality,
  },
  {
    path: "/profile",
    name: "Profile",
    component: Profile,
  },
  {
    path: "/rtl-page",
    name: "Rtl",
    component: Rtl,
  },
  {
    path: "/sign-in",
    name: "Sign In",
    component: SignIn,
  },
  {
    path: "/sign-up",
    name: "Sign Up",
    component: SignUp,
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
  linkActiveClass: "active",
});

export default router;
