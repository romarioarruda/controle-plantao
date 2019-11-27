import Vue from 'vue'

import './styles/quasar.styl'
import '@quasar/extras/material-icons/material-icons.css'
import {
  Quasar, 
  QLayout,
  QHeader,
  QDrawer,
  QPageContainer,
  QPage,
  QToolbar,
  QToolbarTitle,
  QBtn,
  QIcon,
  QList,
  QItem,
  QItemSection,
  QItemLabel,
  QInput,
  QSelect,
  QCard,
  QCardSection,
  QCardActions,
  QSpinnerHourglass,
  QTable,
  QTh,
  QTr,
  QTd,
  QSpinnerCube,
  QDialog,
  QPopupEdit,
  QTooltip,
  QAvatar,
  QDate,
  QPopupProxy

} from 'quasar'

Vue.use(Quasar, {
  config: {},
  components: {
    QLayout,
    QHeader,
    QDrawer,
    QPageContainer,
    QPage,
    QToolbar,
    QToolbarTitle,
    QBtn,
    QIcon,
    QList,
    QItem,
    QItemSection,
    QItemLabel,
    QInput,
    QSelect,
    QCard,
    QCardSection,
    QCardActions,
    QSpinnerHourglass,
    QTable,
    QTh,
    QTr,
    QTd,
    QSpinnerCube,
    QDialog,
    QPopupEdit,
    QTooltip,
    QAvatar,
    QDate,
    QPopupProxy

  },
  directives: {
    
  },
  plugins: {
  }
 })