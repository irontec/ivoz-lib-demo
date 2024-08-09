import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import { AdministratorPropertiesList } from './AdministratorProperties';
import { DropdownChoices } from '@irontec/ivoz-ui';
import store from 'store';

const AdministratorSelectOptions: SelectOptionsType = ({ callback, cancelToken }): Promise<unknown> => {

  const entities = store.getState().entities.entities;
  const Administrator = entities.Administrator;

  return defaultEntityBehavior.fetchFks(
    Administrator.path,
    ['id', 'name'],
    (data: AdministratorPropertiesList) => {

      const options: DropdownChoices = [];
      for (const item of data) {
        options.push({ id: item.id as number, label: item.name as string });
      }

      callback(options);
    },
    cancelToken,
  );
};

export default AdministratorSelectOptions;