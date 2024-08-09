import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { EntityValue } from '@irontec/ivoz-ui';
import { AdministratorProperties, AdministratorPropertyList } from './AdministratorProperties';

const properties: AdministratorProperties = {
  'username': {
    label: _('Username'),
  },
  'pass': {
    label: _('Pass'),
  },
  'email': {
    label: _('Email'),
  },
  'name': {
    label: _('Name'),
  },
  'lastname': {
    label: _('Lastname'),
  },
  'id': {
    label: _('Id'),
  },
};

const Administrator: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'Administrator',
  title: _('Administrator', { count: 2 }),
  path: '/administrators',
  toStr: (row: AdministratorPropertyList<EntityValue>) => String(row.id),
  properties,
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
  foreignKeyResolver: async () => {
    const module = await import('./ForeignKeyResolver');

    return module.default;
  },
  foreignKeyGetter: async () => {
    const module = await import('./ForeignKeyGetter');

    return module.foreignKeyGetter;
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default Administrator;