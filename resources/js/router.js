import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(),
  routes: [
    { path: '/welcome', component: HomePage },
    { path: '/registro', component: RegistroPage },
    {path: '/antecedente', component: AntecedentePage },
    {path: '/hosp', component: HospPage },
    {path: '/diagn', component: DiagnPage },
    {path: '/odontograma', component: OdontogramaPage }
  ]
})
